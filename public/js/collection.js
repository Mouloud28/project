const addbandeAnnonceTeaserFormDeleteLink = (item) => {
  const removeFormButton = document.createElement('button');
  removeFormButton.innerText = 'Supprimer la vidéo';

  item.append(removeFormButton);

  removeFormButton.addEventListener('click', (e) => {
      e.preventDefault();
      // remove the li for the tag form
      item.remove();
  });
}

const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
  
    const item = document.createElement('li');
  
    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(
        /__name__/g,
        collectionHolder.dataset.index
      );

    addbandeAnnonceTeaserFormDeleteLink(item);
    collectionHolder.appendChild(item);
  
    collectionHolder.dataset.index++;
  };

document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", addFormToCollection)
  });

  document
    .querySelectorAll('ul.bandesAnnoncesTeasers li')
    .forEach((bandeAnnonceTeaser) => {
        addbandeAnnonceTeaserFormDeleteLink(bandeAnnonceTeaser)
    })