<?php

namespace App\Exports;

use App\Models\Tender;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProposalsComparisonExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    protected $tender;
    protected $itemsByCategory;

    public function __construct(Tender $tender, Collection $itemsByCategory)
    {
        $this->tender = $tender;
        $this->itemsByCategory = $itemsByCategory;
    }

    public function collection()
    {
        $data = collect();

        // إضافة معلومات المناقصة
        $data->push([
            'type' => 'header',
            'tender_title' => $this->tender->title,
            'tender_date' => $this->tender->created_at->format('Y-m-d'),
            'tender_location' => $this->tender->location,
            'tender_budget' => $this->tender->formatted_budget,
        ]);

        // إضافة ملخص العروض
        if ($this->tender->proposals->count() > 0) {
            $data->push([
                'type' => 'summary',
                'total_proposals' => $this->tender->proposals->count(),
                'min_price' => $this->tender->proposals->min('proposed_price'),
                'max_price' => $this->tender->proposals->max('proposed_price'),
                'avg_price' => $this->tender->proposals->avg('proposed_price'),
            ]);
        }

        // إضافة البنود التفصيلية
        foreach ($this->itemsByCategory as $categoryName => $items) {
            $data->push([
                'type' => 'category',
                'category_name' => $categoryName,
            ]);

            foreach ($items as $item) {
                $isOriginalItem = $this->tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->count() > 0;
                $originalItem = $this->tender->design->items->where('item_name', $item->item_name)->where('category_id', $item->category_id)->first();
                $originalUnitPrice = $originalItem ? $originalItem->unit_price : 0;
                $originalTotalPrice = $originalItem ? $originalItem->total_price : 0;

                $row = [
                    'type' => 'item',
                    'item_name' => ($isOriginalItem ? '' : '[إضافي] ') . $item->item_name,
                    'quantity' => $item->quantity,
                    'unit' => $item->unit ?? '-',
                    'original_unit_price' => $isOriginalItem ? $originalUnitPrice : 0,
                    'original_total_price' => $isOriginalItem ? $originalTotalPrice : 0,
                ];

                // إضافة بيانات كل استشاري
                foreach ($this->tender->proposals as $proposal) {
                    $proposalItem = $proposal->proposalItems->where('tender_item_id', $item->id)->first();
                    $row['consultant_' . $proposal->id . '_name'] = $proposal->consultant->name;
                    $row['consultant_' . $proposal->id . '_unit_price'] = $proposalItem ? $proposalItem->unit_price : 0;
                    $row['consultant_' . $proposal->id . '_total_price'] = $proposalItem ? $proposalItem->total_price : 0;
                    $row['consultant_' . $proposal->id . '_available'] = $proposalItem ? ($proposalItem->is_available ? 'متوفر' : 'غير متوفر') : 'لم يقدم';
                    $row['consultant_' . $proposal->id . '_notes'] = $proposalItem ? $proposalItem->notes : '';
                }

                $data->push($row);
            }
        }

        return $data;
    }

    public function headings(): array
    {
        $headings = [
            'النوع',
            'اسم البند',
            'الكمية',
            'الوحدة',
            'السعر الأصلي (الوحدة)',
            'الإجمالي الأصلي',
        ];

        // إضافة أعمدة لكل استشاري
        foreach ($this->tender->proposals as $proposal) {
            $headings[] = 'الاستشاري: ' . $proposal->consultant->name;
            $headings[] = 'السعر المقترح (الوحدة)';
            $headings[] = 'الإجمالي المقترح';
            $headings[] = 'التوفر';
            $headings[] = 'ملاحظات';
        }

        return $headings;
    }

    public function map($row): array
    {
        if ($row['type'] === 'header') {
            return [
                'معلومات المناقصة',
                $row['tender_title'],
                $row['tender_date'],
                $row['tender_location'],
                $row['tender_budget'],
            ];
        }

        if ($row['type'] === 'summary') {
            return [
                'ملخص العروض',
                'إجمالي العروض: ' . $row['total_proposals'],
                'أقل سعر: ' . number_format($row['min_price'], 2) . ' درهم',
                'أعلى سعر: ' . number_format($row['max_price'], 2) . ' درهم',
                'متوسط السعر: ' . number_format($row['avg_price'], 2) . ' درهم',
            ];
        }

        if ($row['type'] === 'category') {
            return [
                'فئة: ' . $row['category_name'],
                '', '', '', '', ''
            ];
        }

        // للبنود
        $mappedRow = [
            'بند',
            $row['item_name'],
            $row['quantity'],
            $row['unit'],
            $row['original_unit_price'] > 0 ? number_format($row['original_unit_price'], 2) . ' درهم' : 'غير موجود',
            $row['original_total_price'] > 0 ? number_format($row['original_total_price'], 2) . ' درهم' : 'غير موجود',
        ];

        // إضافة بيانات كل استشاري
        foreach ($this->tender->proposals as $proposal) {
            $mappedRow[] = $row['consultant_' . $proposal->id . '_name'];
            $mappedRow[] = $row['consultant_' . $proposal->id . '_unit_price'] > 0 ? number_format($row['consultant_' . $proposal->id . '_unit_price'], 2) . ' درهم' : 'لم يقدم';
            $mappedRow[] = $row['consultant_' . $proposal->id . '_total_price'] > 0 ? number_format($row['consultant_' . $proposal->id . '_total_price'], 2) . ' درهم' : 'لم يقدم';
            $mappedRow[] = $row['consultant_' . $proposal->id . '_available'];
            $mappedRow[] = $row['consultant_' . $proposal->id . '_notes'];
        }

        return $mappedRow;
    }

    public function columnWidths(): array
    {
        $widths = [
            'A' => 15, // النوع
            'B' => 30, // اسم البند
            'C' => 10, // الكمية
            'D' => 10, // الوحدة
            'E' => 20, // السعر الأصلي
            'F' => 20, // الإجمالي الأصلي
        ];

        // إضافة عرض للأعمدة الخاصة بالاستشاريين
        $column = 'G';
        foreach ($this->tender->proposals as $proposal) {
            $widths[$column++] = 20; // اسم الاستشاري
            $widths[$column++] = 20; // السعر المقترح
            $widths[$column++] = 20; // الإجمالي المقترح
            $widths[$column++] = 15; // التوفر
            $widths[$column++] = 30; // ملاحظات
        }

        return $widths;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E3F2FD']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // تطبيق الحدود على جميع الخلايا
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // تنسيق الصفوف الخاصة بالعناوين والفئات
                for ($row = 1; $row <= $highestRow; $row++) {
                    $cellValue = $sheet->getCell('A' . $row)->getValue();

                    if (strpos($cellValue, 'معلومات المناقصة') !== false) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                            'font' => ['bold' => true, 'size' => 14],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'FFE0B2']
                            ],
                        ]);
                    } elseif (strpos($cellValue, 'ملخص العروض') !== false) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                            'font' => ['bold' => true, 'size' => 12],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'E8F5E8']
                            ],
                        ]);
                    } elseif (strpos($cellValue, 'فئة:') !== false) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                            'font' => ['bold' => true, 'size' => 11],
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F3E5F5']
                            ],
                        ]);
                    }
                }

                // محاذاة النص
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }
}

