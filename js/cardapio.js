const ativar=(elemento)=>{
  let itens = document.getElementsByClassName("page-item");
  for(i=0;i<itens.length;i++){
    item[i].classList.remove("active");
  }
  elemento.classList.add("active");
}