const draggables = document.querySelectorAll('.section1');
const containers = document.querySelectorAll('.admin_sections_container');

draggables.forEach(section1 =>{
    section1.addEventListener('dragstart',()=>{
        section1.classList.add('dragging')
    })

    section1.addEventListener('dragend',()=>{
        section1.classList.remove('dragging')
})  
})

containers.forEach(admin_sections_container => {
    admin_sections_container.addEventListener('dragover', e => {
      e.preventDefault()
      const afterElement = getDragAfterElement(admin_sections_container, e.clientY)
      const section1 = document.querySelector('.dragging')
      if (afterElement == null) {
        admin_sections_container.appendChild(section1)
      } else {
        admin_sections_container.insertBefore(section1, afterElement)
      }
    })
  })
  
  function getDragAfterElement(admin_sections_container, y) {
    const draggableElements = [...admin_sections_container.querySelectorAll('.draggable:not(.dragging)')]
  
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