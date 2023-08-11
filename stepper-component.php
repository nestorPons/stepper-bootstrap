<div class="container-fluid">
    <style>
        /* Estilos para el contenedor del stepper */
        .container-stepper {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Estilos para el stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        /* Estilos para cada paso */
        .step {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            border: 2px solid gray;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background-color: white;
            /* Color de fondo para el número */
        }

        /* Estilo para la animación del paso activo */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.4), 0 0 30px rgba(0, 0, 0, 0.4);
                transform: scale(1.05);
            }

            100% {
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                transform: scale(1);
            }
        }

        /* Estilos para el paso activo */
        .step.active {
            border-color: var(--primary-color, #007BFF);
            background-color: var(--primary-color, #007BFF);
            color: white;
            transform: scale(1.1);
            /* Hace el paso activo ligeramente más grande */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4), 0 0 30px rgba(0, 0, 0, 0.4);
            /* Añade una sombra al paso activo */
            /* animation: pulse 1.5s infinite; */
            /* Añade una animación pulsante */
        }

        /* Estilos para la línea entre pasos */
        .step-line {
            height: 2px;
            background-color: gray;
            flex-grow: 1;
            position: relative;
            overflow: hidden;
            /* Oculta el pseudo-elemento fuera de su contenedor */
        }

        .step-line::before {
            content: '';
            position: absolute;
            top: 0;
            right: 100%;
            /* Posiciona el pseudo-elemento completamente a la izquierda al inicio */
            height: 100%;
            width: 100%;
            /* El pseudo-elemento tiene el mismo ancho que su contenedor, pero está oculto al inicio */
            background-color: var(--primary-color, #007BFF);
            transition: right 0.5s linear;
            /* Efecto de transición para la propiedad 'right' */
        }

        .step-line.active::before {
            right: 0;
            /* Cuando la línea es activa, el pseudo-elemento se desplaza a la derecha */
        }

        /* El primer paso se muestra por defecto */
        #step1 {
            display: block;
        }

        .stepper-fade {
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .step-content>div {
            position: absolute;
            width: 100%;
            visibility: hidden;
            /* Cambio aquí */
            opacity: 0;
            /* Cambio aquí */
            transition: opacity 0.5s ease-in-out;
            /* Cambio aquí */
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stepper-fade.stepper-show {
            visibility: visible;
            opacity: 1;
        }

        .step-content {
            position: relative;
        }

        .step-line.active {
            background-color: var(--primary-color, #007BFF);
        }
    </style>

    <div class="container-stepper mt-5">

        <div class="stepper">

            <div class="step active rounded-circle text-center" data-step="1">1</div>

            <div class="step-line" data-line="1"></div>

            <div class="step rounded-circle text-center" data-step="2">2</div>

            <div class="step-line" data-line="2"></div>

            <div class="step rounded-circle text-center" data-step="3">3</div>

        </div>

        <div class="step-content">
            <div id="step1" class="p-3 mt-5 bg-white shadow-sm rounded stepper-fade stepper-show">
                <h2>Contenido Paso 1</h2>
                <p>Lorem ipsum...</p>
            </div>

            <div id="step2" class="p-3 mt-5 bg-white shadow-sm rounded stepper-fade">
                <h2>Contenido Paso 2</h2>
                <p>Lorem ipsum...</p>
            </div>

            <div id="step3" class="p-3 mt-5 bg-white shadow-sm rounded stepper-fade">
                <h2>Contenido Paso 3</h2>
                <p>Lorem ipsum...</p>
            </div>
        </div>

    </div>

    <script>
        // Referencias DOM
        const steps = document.querySelectorAll(".step");
        const stepContents = document.querySelectorAll(".step-content > div");

        // Función para actualizar el estilo del paso activo
        function updateActiveStep(stepNumber) {
            steps.forEach(step => {
                step.classList.remove('active');
            });
            const activeStep = document.querySelector(`.step[data-step="${stepNumber}"]`);
            if (activeStep) {
                activeStep.classList.add('active');
            }
        }

        // Manejador de evento para cada paso
        steps.forEach(step => {
            step.addEventListener("click", function() {
                const stepNumber = this.dataset.step;
                hideAllSteps();
                showStep(stepNumber);
                updateActiveStep(stepNumber);
                updateActiveLine(stepNumber);
            });
        });

        // Función para ocultar todos los contenidos de los pasos
        function hideAllSteps() {
            stepContents.forEach(stepContent => {
                stepContent.classList.remove('stepper-show');
            });
        }

        // Función para mostrar el contenido de un paso específico
        function showStep(stepNumber) {
            const step = document.getElementById('step' + stepNumber);
            if (step) {
                step.classList.add('stepper-show'); // Añade la clase que muestra el contenido con efecto fade
            }
        }

        function updateActiveLine(stepNumber) {
            const stepLines = document.querySelectorAll(".step-line");
            stepLines.forEach(line => {
                if (parseInt(line.dataset.line, 10) < stepNumber) {
                    line.classList.add('active');
                } else {
                    line.classList.remove('active');
                }
            });
        }
    </script>



</div>
