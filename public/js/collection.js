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
