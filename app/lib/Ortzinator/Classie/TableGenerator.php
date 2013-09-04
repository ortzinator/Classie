<?php namespace Ortzinator\Classie;

class TableGenerator
{
	var $rows = array();
	var $headings = array();
	var $tableOpen = '<table>';

	public function addRow($row)
	{
		$this->rows[] = $row;
	}

	public function generate()
	{
		$out = $this->tableOpen;
		$out .= $this->headings();
		foreach ($this->rows as $row) {
			$out .= '<tr>';
			foreach ($row as $value) {
				$out .= '<td>' . $value . '</td>';
			}
			$out .= '</tr>';
		}
		$out .= '</table>';
		return $out;
	}

	private function headings()
	{
		$out = '<tr>';
		foreach ($this->headings as $value) {
			$out .= '<th>' . $value . '</th>';
		}
		$out .= '</tr>';
		return $out;
	}
}