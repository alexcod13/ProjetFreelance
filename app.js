let ouvrir = document.querySelector('.hamburger');
let body = document.querySelector('body');

ouvrir.addEventListener('click', function() {
  body.classList.toggle('open');
});


window.addEventListener('resize', updateUlHeight);
updateUlHeight();

function updateUlHeight() {
	var ulElement = document.querySelector('#divMenu ul');

	if (window.innerWidth <= 700) {
		var windowHeight = window.innerHeight;
		var navBarHeight = 60;
		var ulHeight = windowHeight - navBarHeight;

		ulElement.style.height = ulHeight + 'px';
	} else {
		ulElement.style.height = '60px';
	}

	var htmlElement = document.querySelector('html');
	htmlElement.style.height = windowHeight + 'px';
}




/*
let lastScrollPosition = window.pageYOffset;
let blurMenu = document.getElementById('blurMenu');
let menu = document.getElementById('divMenu');
let scrolling = false;
let scrollThreshold = 10;
let menuVisible = true;


document.addEventListener('click', handleLinkClick);

window.addEventListener('scroll', function() {
  let currentScrollPosition = window.pageYOffset;
  let scrollDifference = currentScrollPosition - lastScrollPosition;

  if (scrollDifference > scrollThreshold) {
    hideMenu();
  } else if (lastScrollPosition > currentScrollPosition) {
    showMenu();
  }

  lastScrollPosition = currentScrollPosition;
});

function hideMenu() {
  if (window.innerWidth > 700 && !scrolling) {
    menu.style.transform = 'translateY(-100%)';
    menu.style.transition = 'transform 0.3s ease-out';
    blurMenu.style.transform = 'translateY(-100%)';
    blurMenu.style.transition = 'transform 0.3s ease-out';
  }
}

function showMenu() {
  if (!scrolling) {
    menu.style.transform = 'translateY(0)';
    menu.style.transition = 'transform 0.3s ease-out';
    blurMenu.style.transform = 'translateY(0)';
    blurMenu.style.transition = 'transform 0.3s ease-out';
  }
}

function handleLinkClick(event) {
	console.log(event)
  if (event.target.matches('a[href^="#"]')) {
    event.preventDefault();

    if (window.innerWidth <= 700) {
      body.classList.toggle('open');
    }

    var targetId = event.target.getAttribute('href').substring(1);
    var targetElement = document.getElementById(targetId);

    if (targetElement) {
      var targetPosition = targetElement.getBoundingClientRect().top - 60;
      var currentPosition = window.pageYOffset;

      scrolling = true;

      window.scrollTo({
        top: targetPosition + currentPosition,
        behavior: 'smooth'
      });

      setTimeout(function() {
        scrolling = false;
      }, 700);
    }
  }
};

window.addEventListener('resize', handleWindowResize);
handleWindowResize();
function handleWindowResize() {
  if (window.innerWidth <= 700) {
    showMenu();
  }
  
  updateUlHeight();
}
*/