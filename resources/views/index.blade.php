<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue.js and Laravel To-Do List</title>
</head>
<body>
<div id="app">
    <h1>To-Do List</h1>
    <input v-model="newTask" @keyup.enter="addTask" placeholder="Add new task">
    <button @click="addTask">Add Task</button>

    <ul>
        <li v-for="task in tasks" :key="task.id">
            <span :class="{ 'completed': task.completed }">{{ task.title }}</span>
            <button @click="toggleTask(task)">
                {{ task.completed ? 'Undo' : 'Complete' }}
            </button>
            <button @click="deleteTask(task)">Delete</button>
        </li>
    </ul>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
