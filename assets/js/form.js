let selectedProgram = document.querySelector('#episode_program')
let seasonsOfProgram = document.querySelector('#episode_season')


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


/*

        seasonsOfProgram.options[0] = new Option(season.number, season.id)

let liked = document.querySelector('.liked')
let disliked = document.querySelector('.disliked')
let satisfaction = document.querySelector('.satisfaction');
let id = document.querySelector('.liked').alt;

liked.addEventListener("click", likeLocation)
disliked.addEventListener("click", dislikeLocation)

function likeLocation() {
  fetch('/liked?id=' + id)
    .then(response => response.json())
    .then(satisfaction => console.log(satisfaction))
  liked.classList.add('likedSelected');
  disliked.classList.remove('dislikedSelected');
  satisfaction.classList.remove('liked');
  satisfaction.classList.remove('disliked');
  liked.removeEventListener("click", likeLocation)
  disliked.removeEventListener("click", dislikeLocation)

 
};
*/