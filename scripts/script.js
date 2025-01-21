document.addEventListener('DOMContentLoaded', () => {

  ////////////////////
  // Initialisation //
  ////////////////////

  // show/hide the tabs
  const tabsContainer = document.getElementById('tabs-container');
  const tabs = document.querySelectorAll('#tabs-container .tab');

  // toggle state
  const auscopeToggle = document.getElementById('auscope-toggle');
  const savedState = localStorage.getItem('auscopeCheckboxState');
  
  //////////////////////
  // The tab toggling //
  //////////////////////

  // Show all antennas: (auscope switch)

  tabs.forEach(tab => {
    tab.style.display = 'none';
  });

  const updateTabVisibility = () => {
    const showAuscopeOnly = auscopeToggle.checked;

    tabs.forEach(tab => {
      const isAuscope = tab.getAttribute('in-auscope-array').trim();
      if (!showAuscopeOnly) {
        if (isAuscope === 'false') {
          tab.style.display = 'none';
        } else {
          tab.style.display = ''; 
        }
      } else {
        tab.style.display = '';
      }
    });
  };

  if (savedState !== null) {
    auscopeToggle.checked = savedState === 'true';
  } else {
    const selectedTab = document.querySelector('.tab.active'); 
    const isSelectedTabAuscope = selectedTab ? selectedTab.getAttribute('in-auscope-array').trim() === 'true' : false;
    auscopeToggle.checked = isSelectedTabAuscope;
  }

  // Show all database data:

  document.getElementById('show-full-toggle').addEventListener('change', function () {
    document.getElementById('toggle-form').submit();
  });

  //////////////////////////
  // The navbar opacacity //
  //////////////////////////

  const handleScroll = () => {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  };

  /////////////////////
  // Event listeners //
  /////////////////////

  window.addEventListener('scroll', handleScroll);

  auscopeToggle.addEventListener('change', () => {
    localStorage.setItem('auscopeCheckboxState', auscopeToggle.checked);
    updateTabVisibility();
  });

  ///////////////////
  // On load calls //
  ///////////////////

  handleScroll();
  updateTabVisibility();

  tabsContainer.classList.add('show');
});
