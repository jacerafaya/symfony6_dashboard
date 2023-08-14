const draggables = document.querySelectorAll('.draggable');
const containers = document.querySelectorAll('.draggable_container');

draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', () => {
      console.log('drag start');
      draggable.classList.add('dragging');
    });
    draggable.addEventListener('dragend', () => {
        draggable.classList.remove('dragging');
    });
});


containers.forEach(draggable_container => {
  draggable_container.addEventListener('dragover', e => {
    e.preventDefault()
    const afterElement = getDragAfterElement(draggable_container, e.clientY)
    const draggable = document.querySelector('.dragging')
    if (afterElement == null) {
      draggable_container.appendChild(draggable)
    } else {
      draggable_container.insertBefore(draggable, afterElement)
    }
  })
})

function getDragAfterElement(draggable_container, y) {
  const draggableElements = [...draggable_container.querySelectorAll('.draggable:not(.dragging)')]

  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect()
    const offset = y - box.top - box.height / 2
    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child }
    } else {
      return closest
    }
  }, { offset: Number.NEGATIVE_INFINITY }).element
}