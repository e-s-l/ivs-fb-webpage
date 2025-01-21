<?php

  /**
   * Return a simplistic quantative summary of the performance of the site for this experiment, to be used to generate the colour-coding
   * 
   * @param $row The array of performance values to assess.
   * @return None
   */
  function assess_quality($row) {

    $performance = (float)($row['Detect_Rate_X'] ?? 0);

    if ($performance > 0.66) {
        return '1';   // green
    } elseif ($performance > 0.33) {
      return '2';     // yellow
    } else {
        return '3';   // red
    }
  }


  /**
   * Render the table for each site wiht each row for an experiement wiht various data values. 
   * Almost directly the database table entries.
   * 
   * @param $row As above/the data row entries.
   * @param $col The header rows entries.
   * @return None
   */
  function renderTable($columns, $rows) {

    if (empty($columns) || empty($rows)) {
        echo "<pre>No data available to display.</pre>";
        return;
    }

    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    foreach ($columns as $column) {
        echo '<th>' . htmlspecialchars($column) . '</th>';
    }
    echo '</tr>';
    echo '</thead>';

    echo '<tbody>';
    foreach ($rows as $row) {
      echo '<tr class="quality-' . assess_quality($row) . '">';
      foreach ($columns as $column) {

        // Set the cell class name
        $cellClass = $column === 'Date' ? 'date' : ($column === 'ExpID' ? 'expid' : '');
        echo '<td class="' . $cellClass . '">';

        // Specific formatting for the Date (& time) cells
        if ($column === 'Date') {
            $dateValue = htmlspecialchars($row['Date'] ?? '');
            $dateParts = explode(' ', $dateValue);
            echo htmlspecialchars($dateParts[0] ?? '') . '<br>';
            echo htmlspecialchars($dateParts[1] ?? '');
        } else {
            echo htmlspecialchars($row[$column] ?? '');
        }
        echo '</td>';
      }
      echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
  }

?>
