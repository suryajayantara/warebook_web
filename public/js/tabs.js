var abstract = document.getElementById('abstract');
var documents = document.getElementById('document');
var abstractbutton = document.getElementById('abstractButton');
var documentbutton = document.getElementById('documentButton');
var buttonadd = document.getElementById('add');

documentbutton.classList.add("border-transparent");
documentbutton.classList.add("opacity-40");
abstractbutton.classList.add("border-current");

documents.classList.add("hidden");

buttonadd.classList.add('hidden');

function tabsView(classname){
    if(classname == 'document'){
        abstract.classList.add("hidden");
        documents.classList.remove("hidden");
        documentbutton.classList.remove("border-transparent");
        documentbutton.classList.remove("opacity-40");
        documentbutton.classList.add("border-current");
        abstractbutton.classList.remove("border-current");
        abstractbutton.classList.add("border-transparent");
        buttonadd.classList.remove('hidden');
    }else {
        abstract.classList.remove("hidden");
        documents.classList.add("hidden");
        documentbutton.classList.add("border-transparent");
        documentbutton.classList.add("opacity-40");
        documentbutton.classList.remove("border-current");
        abstractbutton.classList.add("border-current");
        abstractbutton.classList.remove("border-transparent");
        buttonadd.classList.add('hidden');
    }
} 