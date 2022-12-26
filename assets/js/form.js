let selectedProgram = document.querySelector('#episode_program')
let seasonsOfProgram = document.querySelector('#episode_season')

if (selectedProgram && seasonsOfProgram) {
  selectedProgram.addEventListener('change', (event) => {
    console.log(event.target.value)
    fetch(window.location.protocol + "//" + window.location.host + '/api/program_details/' + event.target.value)
      .then(response => response.json())
      .then(seasons => {
        seasonsOfProgram.options.length = 0
        for (let season of seasons) {
          option = document.createElement("option");
          option.value = season.id;
          option.text = season.number;
          seasonsOfProgram.add(option)
        }
      })
  })
}