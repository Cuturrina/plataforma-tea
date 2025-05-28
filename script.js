document.addEventListener('DOMContentLoaded', function () {
    // Función auxiliar para mostrar mensajes de error
    function displayFormMessage(formId, message, type = 'error') {
        const form = document.getElementById(formId);
        if (!form) return;

        let responseDiv = form.querySelector('.form-response-message');
        if (!responseDiv) {
            responseDiv = document.createElement('div');
            responseDiv.classList.add('form-response-message', 'message');
            form.prepend(responseDiv); 
        }

        responseDiv.textContent = message;
        responseDiv.classList.remove('success', 'error');
        responseDiv.classList.add(type);
    }

    function clearFormMessages(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        const responseDiv = form.querySelector('.form-response-message');
        if (responseDiv) {
            responseDiv.remove();
        }
        // Limpiar estilos de error de los campos
        form.querySelectorAll('.error-field').forEach(field => {
            field.classList.remove('error-field');
        });
    }

    function markFieldError(field) {
        field.classList.add('error-field');
        field.focus();
    }

    // --- FORMULARIO DE CONTACTO ---
    const contactForm = document.getElementById('formContacto');

    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
            clearFormMessages('formContacto'); 
            let hasError = false;
            let errorMessage = "Por favor, corrige los siguientes errores:\n";
            const nombreField = document.getElementById('nombre');
            const emailField = document.getElementById('email');
            const mensajeField = document.getElementById('mensaje');

            // Validar nombre
            if (!nombreField.value.trim()) {
                errorMessage += "- Parece que falta tu nombre. ¿Puedes escribirlo, por favor?\n";
                markFieldError(nombreField);
                hasError = true;
            } else {
                nombreField.classList.remove('error-field');
            }

            // Validar email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailField.value.trim()) {
                errorMessage += "- Necesitamos tu dirección de email para poder contactarte. ¿Puedes escribirla?\n";
                markFieldError(emailField);
                hasError = true;
            } else if (!emailRegex.test(emailField.value)) {
                errorMessage += "- El formato de email no es correcto. Por favor, revisa tu dirección de correo.\n";
                markFieldError(emailField);
                hasError = true;
            } else {
                emailField.classList.remove('error-field');
            }

            // Validar mensaje
            if (!mensajeField.value.trim()) {
                errorMessage += "- Tu mensaje está vacío. ¿Qué nos quieres contar?\n";
                markFieldError(mensajeField);
                hasError = true;
            } else if (mensajeField.value.trim().length < 10) {
                errorMessage += "- Tu mensaje es un poco corto. ¿Puedes detallarnos un poco más?\n";
                markFieldError(mensajeField);
                hasError = true;
            } else {
                mensajeField.classList.remove('error-field');
            }

            if (hasError) {
                event.preventDefault(); 
                displayFormMessage('formContacto', errorMessage, 'error');
            }
        });
    }

    // --- FORMULARIO DE SUGERENCIAS ---
    const sugerenciasForm = document.getElementById('formsugerencias');

    if (sugerenciasForm) {
        sugerenciasForm.addEventListener('submit', function (event) {
            clearFormMessages('formsugerencias'); 
            let hasError = false;
            let errorMessage = "Parece que hay algunos detalles que corregir:\n";
            const sugerenciaField = document.getElementById('sugerencia');

            // Validar sugerencia
            if (!sugerenciaField.value.trim()) {
                errorMessage += "- Tu sugerencia está vacía. ¿Puedes escribirnos qué nos quieres decir?\n";
                markFieldError(sugerenciaField);
                hasError = true;
            } else if (sugerenciaField.value.trim().length < 5) {
                errorMessage += "- Tu sugerencia es un poco corta. ¿Puedes añadir más detalles para entenderla mejor?\n";
                markFieldError(sugerenciaField);
                hasError = true;
            } else {
                sugerenciaField.classList.remove('error-field');
            }

            if (hasError) {
                event.preventDefault(); 
                displayFormMessage('formsugerencias', errorMessage, 'error');
            }
        });
    }

    // --- SIMULADOR DE VISTA MÓVIL ---
    const toggleBtn = document.getElementById("toggle-view-button");
    const overlay = document.getElementById("simulacion-movil-overlay");
    const cerrarBtn = document.getElementById("cerrar-simulador-iframe-boton");
    const iframe = document.getElementById("iframe-movil");

    if (toggleBtn && overlay && cerrarBtn && iframe) {
        toggleBtn.addEventListener("click", () => {
            overlay.style.display = "grid";
            iframe.src = "vista-movil.php";
        });
        cerrarBtn.addEventListener("click", () => {
            overlay.style.display = "none";
            iframe.src = "about:blank";
        });
    }

    // --- MENÚ HAMBURGUESA MÓVIL ---
    function toggleMenuSimulador() {
        const menu = document.getElementById('opcionesSimulador');
        menu.classList.toggle('oculto');
    }

    // Detectar si estamos dentro de un iframe y ocultar el menú simulador si es necesario
    if (window.self !== window.top) {
        // Estamos dentro de un iframe
        const menuSimulador = document.getElementById('toggle-view-button');
        if (menuSimulador) {
            menuSimulador.style.display = 'none'; // Oculta el menú que puede incluir el botón
        }
    }

    // --- MENÚ DESPLEGABLE USUARIO ---
    const userMenu = document.getElementById("user-menu");
    const dropdownMenu = document.getElementById("dropdown-menu");
    if (userMenu && dropdownMenu) {
        userMenu.addEventListener("click", e => {
            e.stopPropagation();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });
        document.addEventListener("click", () => dropdownMenu.style.display = "none");
    }

    // --- JUEGO DE MEMORIA ---
    const cardsArray = ['🍎', '🍌', '🍏', '🍊', '🍉', '🍇', '🍓', '🍒', '🍎', '🍌', '🍏', '🍊', '🍉', '🍇', '🍓', '🍒'];
    let cardValues = [], cardIds = [], cardsMatched = [];
    const board = document.getElementById('memory-board');
    const newGameButton = document.getElementById('new-game-memory');
    let shuffledCards = shuffleArray(cardsArray);

    function shuffleArray(array) {
        return array.sort(() => 0.5 - Math.random());
    }

    function createBoard() {
        board.innerHTML = '';
        for (let i = 0; i < shuffledCards.length; i++) {
            const card = document.createElement('div');
            card.className = 'card';
            card.setAttribute('data-id', i);
            card.addEventListener('click', flipCard);
            board.appendChild(card);
        }
    }

    function flipCard() {
        const selectedCard = this;
        const cardId = selectedCard.getAttribute('data-id');
        selectedCard.textContent = shuffledCards[cardId];
        selectedCard.style.pointerEvents = 'none';

        cardValues.push(shuffledCards[cardId]);
        cardIds.push(cardId);

        if (cardValues.length === 2) {
            setTimeout(checkMatch, 500);
        }
    }

    function checkMatch() {
        const cards = document.querySelectorAll('.card');
        const [firstId, secondId] = cardIds;
        const [firstValue, secondValue] = cardValues;

        if (firstValue === secondValue) {
            cards[firstId].style.backgroundColor = '#D3F9D8';
            cards[secondId].style.backgroundColor = '#D3F9D8';
            cardsMatched.push(cardValues);
        } else {
            cards[firstId].textContent = '';
            cards[secondId].textContent = '';
            cards[firstId].style.pointerEvents = 'auto';
            cards[secondId].style.pointerEvents = 'auto';
        }

        cardValues = [];
        cardIds = [];

        if (cardsMatched.length === cardsArray.length / 2) {
            alert('¡Felicidades! Has emparejado todas las imágenes.');
        }
    }

    if (newGameButton) {
        newGameButton.addEventListener('click', () => {
            cardsMatched = [];
            shuffledCards = shuffleArray(cardsArray);
            createBoard();
        });
    }

    if (board) createBoard();

    // --- PUZZLE 3x3 ---
    const puzzleContainer = document.getElementById('puzzle');
    const newPuzzleButton = document.getElementById('new-game');
    const size = 3;
    let tiles = [...Array(size * size).keys()];
    let shuffledTiles = shuffleArrayPuzzle(tiles);

    function shuffleArrayPuzzle(array) {
        let shuffled;
        do {
            shuffled = [...array].sort(() => Math.random() - 0.5);
        } while (!isSolvable(shuffled));
        return shuffled;
    }

    function isSolvable(tiles) {
        let inversions = 0;
        for (let i = 0; i < tiles.length; i++) {
            for (let j = i + 1; j < tiles.length; j++) {
                if (tiles[i] && tiles[j] && tiles[i] > tiles[j]) inversions++;
            }
        }
        return inversions % 2 === 0;
    }

    function createPuzzle() {
        puzzleContainer.innerHTML = '';
        shuffledTiles.forEach((tile, index) => {
            const tileElement = document.createElement('div');
            tileElement.classList.add('tile');
            tileElement.setAttribute('data-id', tile);
            tileElement.textContent = tile > 0 ? tile : '';
            tileElement.addEventListener('click', () => moveTile(index));
            puzzleContainer.appendChild(tileElement);
        });
    }

    function moveTile(index) {
        const emptyIndex = shuffledTiles.indexOf(0);
        if (canSwap(emptyIndex, index)) {
            [shuffledTiles[emptyIndex], shuffledTiles[index]] = [shuffledTiles[index], shuffledTiles[emptyIndex]];
            updatePuzzle();
            if (isSolved()) {
                setTimeout(() => alert('¡Felicidades! Has completado el rompecabezas.'), 100);
            }
        }
    }

    function canSwap(emptyIndex, tileIndex) {
        const x = Math.floor(emptyIndex / size), y = emptyIndex % size;
        const tileX = Math.floor(tileIndex / size), tileY = tileIndex % size;
        return Math.abs(x - tileX) + Math.abs(y - tileY) === 1;
    }

    function updatePuzzle() {
        const tilesElements = puzzleContainer.querySelectorAll('.tile');
        shuffledTiles.forEach((tile, index) => {
            tilesElements[index].textContent = tile > 0 ? tile : '';
        });
    }

    function isSolved() {
        return shuffledTiles.every((tile, index) => tile === index);
    }

    if (newPuzzleButton && puzzleContainer) {
        newPuzzleButton.addEventListener('click', () => {
            shuffledTiles = shuffleArrayPuzzle(tiles);
            createPuzzle();
        });
        createPuzzle();
    }

    // --- JUEGO SIMON ---
    const colors = ['red', 'blue', 'green', 'yellow'];
    let sequence = [], playerSequence = [], level = 0;
    const startButton = document.getElementById('start');
    const message = document.getElementById('message');
    const colorButtons = document.querySelectorAll('.color-button');

    if (startButton && colorButtons.length > 0) {
        startButton.addEventListener('click', startGame);
    }

    function startGame() {
        sequence = [];
        playerSequence = [];
        level = 0;
        message.textContent = 'Sigue la secuencia';
        nextLevel();
    }

    function nextLevel() {
        level++;
        playerSequence = [];
        sequence.push(colors[Math.floor(Math.random() * 4)]);
        showSequence();
    }

    function showSequence() {
        let i = 0;
        const interval = setInterval(() => {
            activateButton(sequence[i]);
            i++;
            if (i >= sequence.length) clearInterval(interval);
        }, 1000);
    }

    function activateButton(color) {
        const button = document.getElementById(color);
        if (!button) return;
        button.classList.add('active');
        setTimeout(() => button.classList.remove('active'), 500);
    }

    colorButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const selectedColor = e.target.id;
            playerSequence.push(selectedColor);
            checkSequence();
        });
    });

    function checkSequence() {
        const lastIndex = playerSequence.length - 1;
        if (playerSequence[lastIndex] !== sequence[lastIndex]) {
            message.textContent = '¡Error! Inténtalo de nuevo.';
            return;
        }
        if (playerSequence.length === sequence.length) {
            message.textContent = `¡Bien hecho! Nivel ${level}`;
            setTimeout(nextLevel, 1000);
        }
    }

    // --- JUEGO DE EMOCIONES ---
    const emotions = ['😄', '😢', '😡', '😱', '😃'];
    const emotionNames = ['Feliz', 'Triste', 'Enfadado', 'Asustado', 'Contento'];
    let correctEmotion = '';
    const emojiDisplay = document.getElementById('emoji-display');
    const options = document.getElementById('emotion-options');
    const emotionMessage = document.getElementById('emotion-message');

    function newRound() {
        const index = Math.floor(Math.random() * emotions.length);
        correctEmotion = emotionNames[index];
        emojiDisplay.textContent = emotions[index];
        emotionMessage.textContent = '';
    }

    if (emojiDisplay && options && emotionMessage) {
        options.addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                const selected = e.target.textContent;
                emotionMessage.textContent = selected === correctEmotion ? '¡Correcto!' : 'Inténtalo de nuevo';
                if (selected === correctEmotion) setTimeout(newRound, 1000);
            }
        });
        newRound();
    }
});


