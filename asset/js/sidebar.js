function CreateLinkSidebar(els, source) {
  const $div = document.createElement('div');
  els.forEach(ele => {
    const $a = document.createElement('a');
    $a.textContent = ele.textContent;
    
    $a.href = `#${ele.id}`;
    $div.append($a);
  });
  source.append($div);
}

const $mainSidebar = document.querySelector('.sidebar');
const $pageParts = document.querySelectorAll('main details');

$pageParts.forEach($pagePart => {  
  const $sidebar = document.createElement('details');
  
  const $summary = document.createElement('summary');
  $summary.textContent = $pagePart.querySelector('summary')?.textContent || "Section";
  $sidebar.append($summary);

  $mainSidebar.append($sidebar);

  const $allTitle = $pagePart.querySelectorAll('h2, h3, h4');

  CreateLinkSidebar($allTitle, $sidebar);
});
