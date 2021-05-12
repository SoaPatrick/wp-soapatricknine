window.onload = function(){


  // Lightbox function
  if(typeof GLightbox === "function"){
    const glightbox = GLightbox({
      zoomable: false,
      autoplayVideos: false
    });
  }  

 // open/close search
  var searchBtn = document.getElementById('toggle-search-collapse');
  var searchForm = document.getElementById('search-collapse');
  var searchField = document.getElementById('search-collapse__input');

  searchBtn.onclick = function() {
    searchForm.classList.toggle('open');
    searchBtn.classList.toggle('open');
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    if(searchForm.classList.contains('open')) {
      searchField.value = "";
      searchField.focus();
    }
  };

  // Add language to all Code Blocks
  var allCodeBlocks = document.querySelectorAll(".wp-block-code");
  for (var i = 0; i < allCodeBlocks.length; i++) {
    var singleCodeBlock = allCodeBlocks[i].children;
    for (var j = 0; j < singleCodeBlock.length; j++) {
      if (singleCodeBlock[j].hasAttribute("lang")) {
        var codeLang = singleCodeBlock[j].getAttribute("lang");
      }
    }
    allCodeBlocks[i].insertAdjacentHTML('afterbegin', '<div class="prism-language">'+ codeLang +'</div>');
  }
};

// script to load YouTube Videos only on
// click on Preview Image
// ----------------------------------------
document.addEventListener("DOMContentLoaded",function() {
  var div, n,
    v = document.getElementsByClassName("youtube-wrapper__video");
  for (n = 0; n < v.length; n++) {
    div = document.createElement("div");
    div.setAttribute("data-id", v[n].dataset.id);
    div.innerHTML = ytThumb(v[n].dataset.id);
    div.onclick = ytIframe;
    v[n].appendChild(div);
  }
});

function ytThumb(id) {
  var thumbRes = (document.body.clientWidth > 640) ? 'maxresdefault.jpg' : 'hqdefault.jpg',
  thumbImg = '<img src="https://i.ytimg.com/vi/ID/'+thumbRes+'" alt="Youtube Thumbnail">',
  thumbBut = '<button type="button" class="video--play-btn" aria-label="Play Video"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><circle class="video--play-btn__bg" cx="256" cy="256" r="256"/><path class="video--play-btn__play" d="M371.91,244.63,198.36,144.43a13.69,13.69,0,0,0-20.54,11.86v200.4a13.69,13.69,0,0,0,20.54,11.86l173.55-100.2A13.69,13.69,0,0,0,371.91,244.63Z"/></svg></button>';
  return thumbImg.replace("ID", id) + thumbBut;
}


function ytIframe() {
  var iframe = document.createElement("iframe");
  iframe.setAttribute("src", "https://www.youtube-nocookie.com/embed/" + this.dataset.id + "?autoplay=1");
  iframe.setAttribute("frameborder", "0");
  iframe.setAttribute("allowfullscreen", "1");
  iframe.setAttribute("mute", "1");
  iframe.setAttribute("allow", "accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture");
  this.parentNode.replaceChild(iframe, this);
}
