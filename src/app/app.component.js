
const fermerMenu = () => {
    const input = document.getElementById('menuCB ')
    input.checked = false

    const fenetreNode = document.getElementById('menuCote')
    fenetreNode.remove()
}

const changerEtat = () => {
    const input = document.getElementById('menuCB ')
    const actif = input.checked

    if(actif){
        const fenetreNode = document.createElement('div')
        fenetreNode.id = 'menuCote'
        fenetreNode.className = 'menuCote'
        fenetreNode.addEventListener('click', fermerMenu)
        document.body.appendChild(fenetreNode)
    }
    else{
        const fenetreNode = document.getElementById('menuCote')
        fenetreNode.remove()
    }

}

const input = document.getElementById('menuCB ')
input.addEventListener('click', changerEtat)