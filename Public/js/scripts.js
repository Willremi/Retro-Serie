window.onload = () => {
    
    // let divTest = document.querySelectorAll('.test')
    let divList = document.querySelectorAll('.listSerie')
    let btn = document.querySelectorAll('.decennie')
    
    for(let b of btn) {
        // let indexBtn = idBtn.substr(3)

        b.onclick = function () {
            // id de l'élement
            let idBtn = this.getAttribute('id')
            let numBtn = idBtn.substr(3)
            console.log(idBtn)

            // Pour afficher la div adéquate au bouton
            divList.forEach(liste => {
                let numList = liste.id.substr(6)
                // console.log(numList);
                if(numBtn == numList) {
                    console.log(liste.id)
                    if(getComputedStyle(liste).display == "none") {
                        liste.style.display = "block"
                    } else {
                        liste.style.display = "none"
                    }
                } else {
                    liste.style.display = "none"
                }
            })
           
        }
        
    }

    document.querySelectorAll('.table-respo').forEach(function (table) {
        let labels = Array.from(table.querySelectorAll('th')).map(function(th) {
            return th.innerText;
        });
        // Pour chaque td dans table
            // On récupère l'index du td
            // On va mettre le data-label qui correspond
        table.querySelectorAll('td').forEach(function (td, i) {
             td.setAttribute('data-label', labels[i % labels.length]);
             
        });
    });

    let boutonsSupprimer = document.querySelectorAll(".suppComment");

    for(let boutonDelete of boutonsSupprimer) {
        boutonDelete.addEventListener("click", supprimer)
    }
    
    
}

function supprimer() {
    let xmlhttp = new XMLHttpRequest;
    xmlhttp.open('GET', '/serie/supprimeComment/'+this.dataset.id);
    xmlhttp.send()
}