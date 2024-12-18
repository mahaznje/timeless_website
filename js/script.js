let menu = document.querySelector('#menu-icon');
let navlist = document.querySelector('.navlist');

menu.onclick = () =>{
    menu.classList.toggle('bx-x');
    navlist.classList.toggle('open');

}
window.onscroll = () => {
    menu.classList.remove('bx-x');
    navlist.classList.remove('open');
}


document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('sizeModal');
    const btn = document.getElementById('openSizeModal');
    const span = document.getElementsByClassName('close')[0];
    const sizeOptions = document.querySelectorAll('.size-options span');
    const selectedSizeElement = document.getElementById('selectedSize');
    const produitSizeInput = document.getElementById('produit_size'); // Changé en 'produit_size'
    const addToCartBtn = document.getElementById('add-to-cart');
    const produitForm = document.getElementById('produit-form'); // Changé en 'produit-form'

    // Ouvrir la fenêtre modale lorsque le bouton est cliqué
    btn.onclick = function() {
        modal.style.display = 'block';
    }

    // Fermer la fenêtre modale lorsque l'utilisateur clique sur (x)
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Fermer la fenêtre modale lorsque l'utilisateur clique en dehors de la fenêtre
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Gérer le clic sur les options de taille
sizeOptions.forEach(option => {
    option.onclick = function() {
        const selectedSize = this.getAttribute('data-size');
        selectedSizeElement.textContent = `Taille sélectionnée   ${selectedSize.toUpperCase()}`;
        document.getElementById('produit_size').value = selectedSize; // Assurez-vous que l'ID correspond à celui dans votre HTML
        modal.style.display = 'none';
    }
});

    // Gérer le clic sur le bouton "Add to panier"
    document.getElementById('add-to-cart').addEventListener('click', function(e) {
  const selectedSize = document.getElementById('produit_size').value;
  if (!selectedSize) {
    e.preventDefault();
    alert('Veuillez sélectionner une taille avant d\'ajouter au panier.');
  }
});
});