document.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burger');
    const menu = document.getElementById('menu');
    
    burger.addEventListener('click', function() {
        // Переключаем класс active у бургера
        this.classList.toggle('active');
        
        // Переключаем класс active у меню
        menu.classList.toggle('active');
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Находим все изображения в GridView
    var images = document.querySelectorAll('img[src*="/uploads/"]'); // Замените "storage" на часть пути ваших изображений
    
    images.forEach(function(img) {
        img.style.cursor = 'pointer'; // Меняем курсор при наведении
        
        img.addEventListener('click', function() {
            // Создаем overlay
            var overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0,0,0,0.9)';
            overlay.style.zIndex = '1000';
            overlay.style.display = 'flex';
            overlay.style.alignItems = 'center';
            overlay.style.justifyContent = 'center';
            overlay.style.cursor = 'zoom-out';
            
            // Создаем увеличенное изображение
            var enlargedImg = document.createElement('img');
            enlargedImg.src = this.src;
            enlargedImg.style.maxWidth = '90%';
            enlargedImg.style.maxHeight = '90%';
            enlargedImg.style.objectFit = 'contain';
            
            // Добавляем изображение в overlay
            overlay.appendChild(enlargedImg);
            
            // Закрытие при клике
            overlay.addEventListener('click', function() {
                document.body.removeChild(overlay);
            });
            
            // Добавляем overlay на страницу
            document.body.appendChild(overlay);
        });
    });
});