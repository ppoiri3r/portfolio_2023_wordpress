export function filter() { 
  const base_url = window.location.origin;
  let cpt = 'projects';
  let selected;

  getSelectedFilter();
  clearFilters();
  
  function displayPosts(data) {

    let id = data[0].id;
    let excerpt; 
    let title;
    let term;
    let icon;
    let live_site_acf_title;
    let live_site_acf_url;
    let live_site_acf_target;
    let featured_cta;
    let permalink;

    const no_results =  `<h3>Sorry, no results were found. Try using a different filter.</h3>`;

    let retrievedPosts = [];
    data.forEach(data => {
      // term is an array 
      term = data._embedded["wp:term"][0];


      term.forEach(term => {
        if(term.name == 'Shopify') {
          icon = `<svg class="shopify" width="15" height="15" fill="#c1ff72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="c2be471c56fc5b4dd571614bb3052f50"> <path d="M425.228,100.457c0,0-0.425-2.308-1.734-3.144c-1.311-0.836-2.732-0.998-2.732-0.998l-41.082-3.057l-30.228-30.053 c-1.147-0.874-2.471-1.385-3.817-1.66c-3.219-0.624-7.548,0.125-8.347,0.312l-15.682,4.853 c-6.812-20.11-16.118-34.432-27.795-42.716c-8.634-6.101-18.146-8.695-28.363-7.922c-2.146-2.857-4.51-5.352-7.099-7.448 c-11.334-9.157-25.955-10.579-43.446-4.241c-52.454,19.05-74.722,87.029-82.75,120.987L86.437,139.53 c0,0-10.767,3.069-13.293,6.088c-2.775,3.318-3.306,12.301-3.306,12.301l-38.78,299.087L323.215,511.5l157.728-34.133 L425.228,100.457z M263.326,84.763l-50.513,15.632c6.693-26.211,19.555-52.996,44.145-63.438 C262.066,50.331,263.476,68.632,263.326,84.763z M220.897,20.901c10.685-3.88,18.894-3.706,25.069,0.461 c-32.96,15.033-47.351,52.909-53.563,85.357l-40.445,12.525C160.99,86.584,181.144,35.335,220.897,20.901z M249.204,241.318 c-2.314-1.123-5.046-2.321-8.134-3.456c-3.063-1.147-6.475-2.233-10.174-3.131c-3.662-0.898-7.604-1.622-11.758-2.046 c-4.117-0.437-8.44-0.574-12.918-0.312c-4.11,0.25-7.834,0.985-11.109,2.158c-3.256,1.148-6.075,2.745-8.396,4.729 c-2.32,1.971-4.148,4.329-5.439,7.049c-1.279,2.707-2.034,5.751-2.177,9.132c-0.112,2.508,0.281,4.903,1.16,7.235 c0.879,2.346,2.258,4.641,4.129,6.912c1.884,2.295,4.267,4.565,7.167,6.886c2.913,2.358,6.351,4.729,10.317,7.211 c5.564,3.568,11.253,7.585,16.661,12.188c5.489,4.679,10.679,9.956,15.139,15.969c4.517,6.076,8.271,12.888,10.804,20.522 c2.545,7.71,3.849,16.206,3.438,25.562c-0.667,15.308-4.023,28.506-9.569,39.447c-5.477,10.804-13.037,19.287-22.144,25.45 c-8.907,6.013-19.225,9.743-30.446,11.24c-10.897,1.459-22.581,0.811-34.632-1.847c-0.088-0.013-0.188-0.05-0.287-0.075 c-0.094-0.012-0.188-0.037-0.281-0.049c-0.093-0.025-0.187-0.051-0.287-0.075c-0.094-0.013-0.188-0.038-0.287-0.062 c-5.651-1.372-11.104-3.144-16.225-5.228c-5.046-2.033-9.781-4.354-14.097-6.861c-4.254-2.482-8.109-5.14-11.446-7.896 c-3.3-2.732-6.107-5.539-8.309-8.371l13.292-44.113c2.246,1.896,4.99,4.055,8.115,6.237c3.156,2.233,6.706,4.504,10.504,6.637 c3.842,2.146,7.947,4.13,12.17,5.751c4.279,1.635,8.683,2.907,13.049,3.543c3.855,0.562,7.298,0.449,10.311-0.224 c3.038-0.687,5.626-1.946,7.748-3.681c2.133-1.709,3.786-3.893,4.94-6.4c1.154-2.532,1.809-5.364,1.934-8.396 c0.137-3.044-0.138-5.901-0.905-8.671c-0.761-2.781-2.008-5.464-3.799-8.158c-1.791-2.683-4.111-5.377-7.048-8.159 c-2.907-2.757-6.394-5.602-10.523-8.62c-5.084-3.793-9.85-7.897-14.122-12.363c-4.217-4.417-7.959-9.195-11.022-14.372 c-3.031-5.14-5.42-10.691-6.967-16.729c-1.541-6.001-2.251-12.501-1.953-19.587c0.524-11.839,2.889-22.755,6.85-32.573 c4.004-9.931,9.674-18.838,16.785-26.511c7.255-7.822,16.075-14.422,26.242-19.499c10.461-5.228,22.419-8.895,35.674-10.629 c6.15-0.812,12.052-1.186,17.628-1.21c5.664-0.025,10.985,0.312,15.881,0.936c4.965,0.636,9.488,1.559,13.499,2.694 c4.042,1.147,7.548,2.495,10.436,3.967L249.204,241.318z M280.836,79.349c-0.025-1.983-0.075-3.992-0.149-6.038 c-0.587-15.719-2.721-28.956-6.351-39.685c3.955,0.399,7.548,1.709,10.829,4.03c9.145,6.475,15.731,19.511,20.372,34.045 L280.836,79.349z"> </path> </g> </g></svg>`;
        } else if(term.name == 'Wordpress') {
          icon = `<svg class="wordpress" width="15" height="15" version="1.1" id="svg2" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" sodipodi:docname="wordpress.svg" inkscape:version="0.48.4 r9939" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1200 1200" enable-background="new 0 0 1200 1200" xml:space="preserve" fill="#c1ff72" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path id="path26266" inkscape:connector-curvature="0" d="M599.314,1200C264.241,1193.561,2.343,918.889,0,599.314 C6.515,264.491,279.729,2.343,599.314,0C934.157,6.694,1197.654,279.298,1200,599.314 C1193.381,934.406,919.318,1197.654,599.314,1200z M599.314,42.514C288.196,48.64,43.307,302.232,41.143,599.314 c6.051,311.365,261.102,556.007,558.171,558.171c311.365-6.053,556.007-261.103,558.172-558.171 C1151.613,287.967,895.954,44.676,599.314,42.514L599.314,42.514z M455.314,1090.285l153.6-441.6l160.457,432 C661.269,1116.874,559.068,1119.067,455.314,1090.285L455.314,1090.285z M337.371,309.943 c-56.23,7.644-110.916,10.369-164.571,8.229C274.677,172.521,437.796,90.579,599.314,89.143c132.109,2.5,255.27,52.438,345.6,134.4 c-41.893-3.097-66.977,15.276-85.028,46.628c-26.234,80.939,29.201,140.853,60.344,201.601 c29.443,55.505,27.108,118.618,10.971,172.8l-76.8,261.943L669.258,356.571c19.291-1.795,38.708-2.373,56.229-5.486 c20.736-4.617,25.286-23.914,10.971-35.657c-4.57-3.656-9.6-5.484-15.086-5.484l-111.085,8.229h-84.343 c-23.813,1.406-91.053-21.597-96.688,9.601c-2.911,12.017,6.06,21.436,16.457,23.313c18.346,2.377,39.365,5.076,56.229,6.857 l80.914,216.686L470.4,906.515L283.886,356.571c19.736-1.714,39.733-2.312,57.6-5.486c14.63-1.833,21.028-9.146,19.2-21.943 C358.093,317.765,347.952,310.078,337.371,309.943L337.371,309.943z M131.657,394.972l245.486,663.771 c-88.577-43.659-158.606-107.864-208.458-184.458C77.49,728.754,67.897,544.121,131.657,394.972L131.657,394.972z M1090.972,735.771 c-40.303,131.608-122.616,240.613-236.57,306.515c5.484-14.629,14.171-39.314,26.057-74.058l142.629-414.172 c13.714-40.229,23.314-85.028,28.8-134.399c1.853-20.199,1.914-40.564-1.371-58.972 C1108.954,486.728,1125.532,611.577,1090.972,735.771L1090.972,735.771z"></path> </g></svg>`;
        }
      })

      title = data.title.rendered; 
      excerpt = data.excerpt.rendered; 
      live_site_acf_title = data.acf.live_site.title;
      live_site_acf_url = data.acf.live_site.url;
      live_site_acf_target = data.acf.live_site.target;
      featured_cta = data.acf.featured_cta;
      permalink = data.link;
      

      // console.log(data);
      retrievedPosts.push(
        `<li id="post-${id}" class="post-${id}">
          <h3 class="entry-title">${title}<span>${icon}</span></h3>
          ${excerpt}
          <div class="links">
          ${(() => {
            if (featured_cta) {
              return `
                  <a class="secondary internal" href="${permalink}">${featured_cta}</a>
              `;
            } else {
              return ``;
            }
          })()}
          ${(() => {
            if (live_site_acf_url && live_site_acf_title && live_site_acf_target) {
              return `
                  <a class="secondary" target="${live_site_acf_target}" href="${live_site_acf_url}">${live_site_acf_title}</a>
              `;
            } else {
              return ``;
            }
          })()}
          </div>
        </li>`
      )
    })

    if(retrievedPosts) {
      $('.progress').addClass('show');
      $('.feature__works ul li').remove();
      setTimeout(() => {
        $('.feature__works ul').html(retrievedPosts);
        $('.progress').removeClass('show');
      }, "1000");

    } else if(!retrievedPosts || retrievedPosts.length == 0) {
      $('.progress').addClass('show');
      $('.feature__works ul li').remove();
      setTimeout(() => {
        $('.feature__works ul').remove();
        $('.feature__works').html(no_results);
        $('.progress').removeClass('show');
      }, "1000");
    }
  }
  
  function getSelectedFilter() {
    $('#filter').on('change', function(e) {
      selected = $(e.target).val();
      fetch(`${base_url}/wp-json/wp/v2/${cpt}?&project-type=${selected}&_embed=1`)
        .then(response => response.json())
        .then(response => {
          $('.feature__works ul li').remove();
          displayPosts(response, selected);
        });
    })
  }

  function clearFilters() {
    $('#clear').on('click', function() {
      $('#filter')[0].reset();

      
      selected = $('#filter input')
      let selectedArr = $.map(selected, function(val, index){
        return [val.value];
      })


      fetch(`${base_url}/wp-json/wp/v2/${cpt}?&project-type=${selectedArr}&_embed=1`)
        .then(response => response.json())
        .then(response => {
          displayPosts(response);
        });
    })
  }
}
