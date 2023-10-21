// Select2 : Sélection multiple.

$(document).ready(function () {
$('.select-2').each(function () {
var placeholder = $(this).data('placeholder');
  
$(this).select2({placeholder: placeholder, allowClear: true});
});
});

// Films

const addbandeAnnonceTeaserFormDeleteLink = (item) => {
  const removeFormButton = document.createElement("button");
  removeFormButton.innerText = "Supprimer la vidéo";
  removeFormButton.classList.add("mt-2", "mb-2", "form-control")

  item.append(removeFormButton);

  removeFormButton.addEventListener("click", (e) => {
    e.preventDefault();
    // remove the li for the tag form
    item.remove();
  });
};

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
};

document.querySelectorAll(".add_item_link").forEach((btn) => {
  btn.addEventListener("click", addFormToCollection);
});

document
  .querySelectorAll("ul.bandesAnnoncesTeasers li")
  .forEach((bandeAnnonceTeaser) => {
    addbandeAnnonceTeaserFormDeleteLink(bandeAnnonceTeaser);
  });

// Séries

const addbandeAnnonceTeaserFormDeleteLink2 = (item) => {
  const removeFormButton = document.createElement("button");
  removeFormButton.innerText = "Supprimer la vidéo";

  item.append(removeFormButton);

  removeFormButton.addEventListener("click", (e) => {
    e.preventDefault();
    // remove the li for the tag form
    item.remove();
  });
};

const addFormToCollection2 = (e) => {
  const collectionHolder = document.querySelector(
    "." + e.currentTarget.dataset.collectionHolderClass
  );

  const item = document.createElement("li");

  item.innerHTML = collectionHolder.dataset.prototype.replace(
    /__name__/g,
    collectionHolder.dataset.index
  );

  addbandeAnnonceTeaserFormDeleteLink2(item);
  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;
};

document.querySelectorAll(".add_item_link").forEach((btn) => {
  btn.addEventListener("click", addFormToCollection);
});

document
  .querySelectorAll("ul.bandesAnnoncesTeasers li")
  .forEach((bandeAnnonceTeaser) => {
    addbandeAnnonceTeaserFormDeleteLink(bandeAnnonceTeaser);
  });

  // Notation

  // On récupère toutes les étoiles
var toutesLesEtoiles = $('.stars .star');
// console.log(toutesLesEtoiles);

// On rajoute l'écouteur au clic;
// toutesLesEtoiles.click(onStarClick)
toutesLesEtoiles.click(onStarClick);

// On gère ce qui se passe lors du clic d'une étoile
function onStarClick(event) {

	// On récupère l'objet cliqué, AU FORMAT JQUERY
	var etoileCliquée = $(this);
	// console.log(etoileCliquée);

	// On récupère son index ("Quelle étoile a été cliquée ?") depuis sont attribut data-index
	var indexCliqué = etoileCliquée.data("index");
	// console.log(indexCliqué);

	// On récupère son parent (afin de rendre ça réutilisable pour d'autres groupes)
	var parent = $(this).parent();

	// Style : "Vider" toutes les étoiles.. de ce groupe
	parent.find('.star').addClass('stargrey');
	parent.find('.star').removeClass('blue');

	// Style : "Remplir" le bon nombre d'étoiles
	// Pour ce groupe, pour chaque étoile de 0 jusqu'à celle cliquée..
	for (var i = 0; i <= indexCliqué; i++) {

		var etoile = parent.find('.star[data-index=' + i + ']');
		// console.log( etoile );

		// Je remplie
		etoile.addClass('blue');
		etoile.removeClass('stargrey');
	}
}

$('.ratings_stars').hover(
  // Handles the mouseover
  function() {
      $(this).prevAll().andSelf().addClass('ratings_over');
      $(this).nextAll().removeClass('ratings_vote'); 
  },
  // Handles the mouseout
  function() {
      $(this).prevAll().andSelf().removeClass('ratings_over');
      set_votes($(this).parent());
  }
);

$('.stars').each(function(i) {
  var widget = this;
  var out_data = {
      widget_id : $(widget).attr('id'),
      fetch: 1
  };
  $.post(
      'ratings.php',
      out_data,
      function(INFO) {
          $(widget).data( 'fsr', INFO );
          set_votes(widget);
      },
      'json'
  );
});

// $('#one_of_your_widgets).data('fsr').widget_id;