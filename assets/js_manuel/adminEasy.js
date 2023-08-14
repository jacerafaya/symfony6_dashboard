const draggables = document.querySelectorAll('tr');
const containers = document.querySelectorAll('tbody');

draggables.forEach(tr =>{
    tr.addEventListener('dragstart',()=>{
        tr.classList.add('dragging')
    })

    tr.addEventListener('dragend',()=>{
        tr.classList.remove('dragging')
})  
})

containers.forEach(tbody => {
    tbody.addEventListener('dragover', e => {
      e.preventDefault()
      const afterElement = getDragAfterElement(tbody, e.clientY)
      const tr = document.querySelector('.dragging')
      if (afterElement == null) {
        tbody.appendChild(tr)
      } else {
        tbody.insertBefore(tr, afterElement)
      }
    })
  })
  
  function getDragAfterElement(tbody, y) {
    const draggableElements = [...tbody.querySelectorAll('.draggable:not(.dragging)')]
  
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