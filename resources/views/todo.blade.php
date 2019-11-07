<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex-container">
            <div class="flex-item">
                <div>
                    <div>
                        <input name="task" class="input" placeholder="New To Do" /><button id="save" class="button">Add Task</button>
                    </div>
                    <div class="text-display">
                        Type in new to do ...
                    </div>
                </div>
                <div class="todo-list">
                </div>
                <div>
                    <button id="remove" class="button">Delete Task</button>
                </div>
            </div>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>
