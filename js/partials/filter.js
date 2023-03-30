export function filter() { 
  getSelectedFilter();
  
  function displayPosts(data) {
    console.log(data)

    let id = data[0].id;
    console.log(id);
    let excerpt; 
    let title;

    const no_results =  `<div>Sorry, no results were found. Try using a different filter.</div>`;

    let retrievedPosts = [];
    data.forEach(data => {

      title = data.title.rendered; 
      excerpt = data.excerpt.rendered; 

      console.log(data);
      retrievedPosts.push(
        `<li id="post-${id}" class="post-${id}">
          <h3 class="entry-title">${title}</h3>
          <p class="entry-excerpt">${excerpt}</p>
        </li>`
      )
    })
    console.log(retrievedPosts);
    console.log(retrievedPosts.length);

    if(retrievedPosts) {
      $('.feature__works ul').html(retrievedPosts);
    }
  }
  
  
  function getSelectedFilter() {
    let selected;
    const base_url = window.location.origin;
    let cpt = 'projects';

    $('#filter').on('change', function(e) {
      selected = $(e.target).val();
      fetch(`${base_url}/wp-json/wp/v2/${cpt}?&project-type=${selected}&_embed=1`)
        .then(response => response.json())
        .then(response => {
          $('.feature__works ul li').remove();
          displayPosts(response);
        });
    })
  }
}
