// Select2 : Sélection multiple.

$(document).ready(function () {
  $(".select-2").each(function () {
    var placeholder = $(this).data("placeholder");

    $(this).select2({ placeholder: placeholder, allowClear: true });
  });
});

// Fonction pour ajouter un bouton "Supprimer" à une bande-annonce
const addbandeAnnonceTeaserFormDeleteLink = (item) => {
  if (!item.querySelector(".delete-button")) { // Vérifie si le bouton "Supprimer" n'existe pas déjà
    const removeFormButton = document.createElement("button");
    removeFormButton.innerText = "Supprimer la vidéo";
    removeFormButton.classList.add("mt-2", "mb-2", "form-control", "delete-button");

    // Définir la largeur du bouton
    removeFormButton.style.width = "200px"; // Remplacez la valeur par la largeur souhaitée en pixels
    removeFormButton.style.marginLeft = "50px"; // Padding-left souhaité en pixels
    removeFormButton.style.backgroundColor = "rgba(217, 217, 217)"; // Définir une couleur de fond
    removeFormButton.style.fontWeight = "bold"; // Définir une couleur de fond

    item.append(removeFormButton);

    removeFormButton.addEventListener("click", (e) => {
      e.preventDefault();
      // Marquer l'élément comme supprimé
      item.classList.add('deleted');
      // Masquer le contenu de l'élément
      item.style.display = 'none';
    });
  }
};

// Fonction pour ajouter un élément de formulaire à la collection
const addFormToCollection = (e) => {
  const collectionHolder = document.querySelector(
    "." + e.currentTarget.dataset.collectionHolderClass
  );

  const item = document.createElement("li");

  item.innerHTML = collectionHolder.dataset.prototype.replace(
    /__name__/g,
    collectionHolder.dataset.index
  );

  addbandeAnnonceTeaserFormDeleteLink(item);
  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;

  // Ajoutez le JavaScript ici pour générer des noms de champs uniques
  var index = collectionHolder.dataset.index;
  var prototype = collectionHolder.dataset.prototype;

  // Modifiez le prototype pour générer des noms de champs uniques
  var newForm = prototype.replace(/__name__/g, index);

  // Ajoutez le nouveau formulaire à la collection
  collectionHolder.appendChild(newForm);
};

document.querySelectorAll(".add_item_link").forEach((btn) => {
  btn.addEventListener("click", addFormToCollection);
});

document.querySelectorAll("ul.bandesAnnoncesTeasers li").forEach((bandeAnnonceTeaser) => {
  addbandeAnnonceTeaserFormDeleteLink(bandeAnnonceTeaser);
});

// // Notation

// // On récupère toutes les étoiles
// var toutesLesEtoiles = $(".stars .star");
// // console.log(toutesLesEtoiles);

// // On rajoute l'écouteur au clic;
// // toutesLesEtoiles.click(onStarClick)
// toutesLesEtoiles.click(onStarClick);

// // On gère ce qui se passe lors du clic d'une étoile
// function onStarClick(event) {
//   // On récupère l'objet cliqué, AU FORMAT JQUERY
//   var etoileCliquée = $(this);
//   // console.log(etoileCliquée);

//   // On récupère son index ("Quelle étoile a été cliquée ?") depuis sont attribut data-index
//   var indexCliqué = etoileCliquée.data("index");
//   // console.log(indexCliqué);

//   // On récupère son parent (afin de rendre ça réutilisable pour d'autres groupes)
//   var parent = $(this).parent();

//   // Style : "Vider" toutes les étoiles.. de ce groupe
//   parent.find(".star").addClass("stargrey");
//   parent.find(".star").removeClass("blue");

//   // Style : "Remplir" le bon nombre d'étoiles
//   // Pour ce groupe, pour chaque étoile de 0 jusqu'à celle cliquée..
//   for (var i = 0; i <= indexCliqué; i++) {
//     var etoile = parent.find(".star[data-index=" + i + "]");
//     // console.log( etoile );

//     // Je remplie
//     etoile.addClass("blue");
//     etoile.removeClass("stargrey");
//   }
// }

// $(".ratings_stars").hover(
//   // Handles the mouseover
//   function () {
//     $(this).prevAll().andSelf().addClass("ratings_over");
//     $(this).nextAll().removeClass("ratings_vote");
//   },
//   // Handles the mouseout
//   function () {
//     $(this).prevAll().andSelf().removeClass("ratings_over");
//     set_votes($(this).parent());
//   }
// );

// $(".stars").each(function (i) {
//   var widget = this;
//   var out_data = {
//     widget_id: $(widget).attr("id"),
//     fetch: 1,
//   };
//   $.post(
//     "ratings.php",
//     out_data,
//     function (INFO) {
//       $(widget).data("fsr", INFO);
//       set_votes(widget);
//     },
//     "json"
//   );
// });

window.onload = () => {
  // On va chercher toutes les étoiles
  const stars = document.querySelectorAll(".la-star");

  // On va chercher l'input
  const note = document.querySelector("#note")

  // On boucle sur les étoiles pour leur ajouter des écouteurs d'évènement
  for(star of stars){
    // On écoute le survol
    star.addEventListener("mouseover", function(){
      resetStars();
      this.style.color = "red";
      this.classList.add("las");
      this.classList.remove("lar");

      // L'élément précédent dans le DOM (de même niveau, balise soeur)

      let previousStar = this.previousElementSibling;

      while(previousStar){
        // On passe l'étoile qui précède en rouge.
        previousStar.style.color = "red";
        previousStar.classList.add("las");
        previousStar.classList.remove("lar");
        // On récupère l'étoile qui la précède.
        previousStar = previousStar.previousElementSibling;
      }
    });

    // On écoute le click.
    star.addEventListener("click", function(){
      note.value = this.dataset.value;
    });

    star.addEventListener("mouseout", function(){
      resetStars(note.value);
    });
  }

  function resetStars(note = 0){
    for(star of stars){
      if(star.dataset.value > note){
        star.style.color = "black";
        star.classList.add("lar");
        star.classList.remove("las");
      }else{
        star.style.color = "red";
        star.classList.add("las");
        star.classList.remove("lar");
      }
    }
  }
}

// $('#one_of_your_widgets).data('fsr').widget_id;
