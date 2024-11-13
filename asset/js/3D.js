/* Store the element in el */
let el = document.querySelectorAll('.exemple')

el.forEach(ele => {
  /* Get the height and width of the element */
  const height = ele.clientHeight
  const width = ele.clientWidth

  /*
    * Add a listener for mousemove event
    * Which will trigger function 'handleMove'
    * On mousemove
    */
  ele.addEventListener('mousemove', handleMove)

  /* Define function a */
  function handleMove(e) {
    /*
      * Get position of mouse cursor
      * With respect to the element
      * On mouseover
      */
    /* Store the x position */
    const xVal = e.layerX
    /* Store the y position */
    const yVal = e.layerY

    /*
      * Calculate rotation valuee along the Y-axis
      * Here the multiplier 20 is to
      * Control the rotation
      * You can change the value and see the results
      */
    const yRotation = 5 * ((xVal - width / 2) / width)

    /* Calculate the rotation along the X-axis */
    const xRotation = -5 * ((yVal - height / 2) / height)

    /* Generate string for CSS transform property */
    const string = 'perspective(250px) scale(1.1) rotateX(' + xRotation + 'deg) rotateY(' + yRotation + 'deg)'

    /* Apply the calculated transformation */
    ele.style.transform = string
  }

  /* Add listener for mouseout event, remove the rotation */
  ele.addEventListener('mouseout', function () {
    ele.style.transform = 'perspective(500px) scale(1) rotateX(0) rotateY(0)'
  })

  /* Add listener for mousedown event, to simulate click */
  ele.addEventListener('mousedown', function () {
    el.style.transform = 'perspective(500px) scale(0.9) rotateX(0) rotateY(0)'
  })

  /* Add listener for mouseup, simulate release of mouse click */
  ele.addEventListener('mouseup', function () {
    ele.style.transform = 'perspective(500px) scale(1.1) rotateX(0) rotateY(0)'
  })
});

