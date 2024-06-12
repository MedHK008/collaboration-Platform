var input=document.querySelector("#input");
input.addEventListener("input",e=>{
    const input_value=e.target.value.toLowerCase();
    const titles=document.querySelectorAll('.content2 h3');
    const contents=document.querySelectorAll('.content2 p');
    const keyWords=document.querySelectorAll('.info .keyword');


    
    titles.forEach(title=>{
        if(title.textContent.toLowerCase().includes(input_value))
            title.parentNode.parentNode.parentNode.style.display="block";
        else 
        title.parentNode.parentNode.parentNode.style.display="none";
        
    });
    contents.forEach(content=>{
        if(content.textContent.toLowerCase().includes(input_value))
            content.parentNode.parentNode.parentNode.style.display="block";
        else 
        content.parentNode.parentNode.parentNode.style.display="none";
        
    });
    /*keyWords.forEach(keyword=>{
        if(keyword.textContent.toLowerCase().includes(input_value))
            keyword.parentNode.parentNode.parentNode.parentNode.style.display="block";
        else 
            keyword.parentNode.parentNode.parentNode.parentNode.style.display="none";
        
    });*/
})