<?php

namespace WPForms\Vendor\Box\Spout\Writer\Common\Creator;

use WPForms\Vendor\Box\Spout\Writer\Common\Entity\Sheet;
use WPForms\Vendor\Box\Spout\Writer\Common\Entity\Workbook;
use WPForms\Vendor\Box\Spout\Writer\Common\Entity\Worksheet;
use WPForms\Vendor\Box\Spout\Writer\Common\Manager\SheetManager;
/**
 * Class InternalEntityFactory
 * Factory to create internal entities
 */
class InternalEntityFactory
{
    /**
     * @return Workbook
     */
    public function createWorkbook()
    {
        return new Workbook();
    }
    /**
     * @param string $worksheetFilePath
     * @param Sheet $externalSheet
     * @return Worksheet
     */
    public function createWorksheet($worksheetFilePath, Sheet $externalSheet)
    {
        return new Worksheet($worksheetFilePath, $externalSheet);
    }
    /**
     * @param int $sheetIndex Index of the sheet, based on order in the workbook (zero-based)
     * @param string $associatedWorkbookId ID of the sheet's associated workbook
     * @param SheetManager $sheetManager To manage sheets
     * @return Sheet
     */
    public function createSheet($sheetIndex, $associatedWorkbookId, $sheetManager)
    {
        return new Sheet($sheetIndex, $associatedWorkbookId, $sheetManager);
    }
    /**
     * @return \ZipArchive
     */
    public function createZipArchive()
    {
        return new \ZipArchive();
    }
}
