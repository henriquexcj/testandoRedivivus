// Função para fazer a solicitação AJAX e exibir os comentários atualizados no DOM
  function fetchAndDisplayComments() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php', true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        var comentarios = JSON.parse(xhr.responseText);
        var commentsContainer = document.getElementById('commentsContainer');
        commentsContainer.innerHTML = ''; // Limpa o conteúdo anterior

        comentarios.forEach(function (comentario) {
          var comment = comentario.comentario;
          var name = comentario.nome_usuario;
          var estrelas = comentario.estrelas;

          var swiperSlide = document.createElement('div');
          swiperSlide.className = 'swiper-slide';

          var testimonialItem = document.createElement('div');
          testimonialItem.className = 'testimonial-item';

          var row = document.createElement('div');
          row.className = 'row gy-4 justify-content-center';

          var col1 = document.createElement('div');
          col1.className = 'col-lg-6';

          var testimonialContent = document.createElement('div');
          testimonialContent.className = 'testimonial-content';

          var quoteIconLeft = document.createElement('i');
          quoteIconLeft.className = 'bi bi-quote quote-icon-left';

          var commentText = document.createElement('p');
          commentText.innerHTML = '<i class="bi bi-quote quote-icon-left"></i>' + comment + '<i class="bi bi-quote quote-icon-right"></i>';

          var h3 = document.createElement('h3');
          h3.textContent = name;

          var stars = document.createElement('div');
          stars.className = 'stars';

          for (var i = 1; i <= estrelas; i++) {
            var starFill = document.createElement('i');
            starFill.className = 'bi bi-star-fill';
            stars.appendChild(starFill);
          }

          var col2 = document.createElement('div');
          col2.className = 'col-lg-2 text-center';

          var testimonialImg = document.createElement('img');
          testimonialImg.src = 'assets/img/testimonials/testimonials-1.jpg';
          testimonialImg.className = 'img-fluid testimonial-img';
          testimonialImg.alt = '';

          col1.appendChild(testimonialContent);
          col1.appendChild(col2);
          testimonialContent.appendChild(commentText);
          testimonialContent.appendChild(h3);
          testimonialContent.appendChild(stars);
          col2.appendChild(testimonialImg);
          row.appendChild(col1);
          testimonialItem.appendChild(row);
          swiperSlide.appendChild(testimonialItem);
          commentsContainer.appendChild(swiperSlide);
        });
      }
    };
    xhr.send();
  }

  // Chama a função para exibir os comentários ao carregar a página
  fetchAndDisplayComments();

