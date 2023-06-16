
let pdf = document.getElementById("pdf").value,
  csrf_name = document.getElementById("csrf_name").value,
  csrf_value = document.getElementById("csrf_value").value;

//let url = `leitor/arquivo?pdf=${pdf}&csrf_name=${csrf_name}&csrf_value=${csrf_value}`;
let url = `pdf/${pdf}`;

const renderPage = (pageNumber, canvas) => {
  thePdf.getPage(pageNumber).then(function(page) {
    viewport = page.getViewport({ scale: 1.5 });
    canvas.height = viewport.height;
    canvas.width = viewport.width;          
    page.render({canvasContext: canvas.getContext('2d'), viewport: viewport});
  });
}

var loadingTask = pdfjsLib.getDocument(url);
loadingTask.promise.then(function(pdf) {
  thePdf = pdf;
  viewer = document.getElementById('pdf-viewer');
  
  for(page = 1; page <= pdf.numPages; page++) {
    canvas = document.createElement("canvas");    
    canvas.className = 'pdf-page-canvas';         
    viewer.appendChild(canvas);            
    renderPage(page, canvas);
  }
}, function (reason) {
  // PDF loading error
  alert("Um erro aconteceu ao ler o PDF (PDF não encontrado ou navegador não suportado), favor contatar o suporte!");
  console.error(reason);
});