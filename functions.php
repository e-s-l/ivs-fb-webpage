<?php

  ///////////////
  // Functions //
  ///////////////

  function assess_quality($row) {

    $performance = (float)($row['Detect_Rate_X'] ?? 0);

    if ($performance > 0.66) {
        return '1';
    } elseif ($performance > 0.33) {
      return '2';
    } else {
        return '3';
    }
  }

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
            $cellClass = $column === 'Date' ? 'date' : ($column === 'ExpID' ? 'expid' : '');
            echo '<td class="' . $cellClass . '">';
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
