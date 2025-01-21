
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antenna IVS Performance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
      <navbar class="navbar" id="navbar">
        <div class="tabs" id="tabs-container">
          <?php foreach ($tables as $table): ?>
                  <a href="?table=<?= htmlspecialchars($table) ?>"
                  class="tab <?= $table === $selectedTable ? 'active' : '' ?>"
                  in-auscope-array="<?= in_array($table, $auscope) ? 'true' : 'false' ?>
                  ">
                      <?= htmlspecialchars($table) ?>
                  </a>
          <?php endforeach; ?>
        </div>
        <div class="view-options">
          <div class="toggle_view_auscope">
            <input type="checkbox" id="auscope-toggle"/>
            <label for="auscope-toggle">all sites</label>
          </div>
          <div class="toggle_view_full">
            <form id="toggle-form" method="get">
              <input type="checkbox" id="show-full-toggle" name="showFull" value="1" <?= isset($_GET['showFull']) && $_GET['showFull'] === '1' ? 'checked' : '' ?>/>
              <label for="show-full-toggle">all data</label>
              <input type="hidden" name="table" value="<?= htmlspecialchars($selectedTable) ?>">
              <button type="submit" style="display: none;"></button>
            </form>
          </div>
        </div>
      </navbar>
    </header>
    <main>
      <div class="table-container">
        <h2>Site: <?= htmlspecialchars($selectedTable) ?></h2>
        <?php renderTable($columns, $rows) ?>
      </div>
    </main>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
