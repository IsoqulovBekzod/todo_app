
import { createApp } from 'vue';
import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const app = createApp({
    data() {
        return {
            tasks: [],
            newTask: ''
        };
    },
    mounted() {
        this.fetchTasks();
        Echo.channel('tasks')
            .listen('TaskUpdated', (event) => {
                this.tasks = this.tasks.map(task =>
                    task.id === event.task.id ? event.task : task
                );
            });
    },
    methods: {
        fetchTasks() {
            axios.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data;
                });
        },
        addTask() {
            axios.post('/api/tasks', { title: this.newTask })
                .then(response => {
                    this.tasks.unshift(response.data);
                    this.newTask = '';
                });
        },
        toggleTask(task) {
            axios.put(`/api/tasks/${task.id}`, { completed: !task.completed })
                .then(response => {
                    this.tasks = this.tasks.map(t =>
                        t.id === task.id ? response.data : t
                    );
                    this.$emit('taskUpdated', response.data);
                });
        },
        deleteTask(task) {
            axios.delete(`/api/tasks/${task.id}`)
                .then(() => {
                    this.tasks = this.tasks.filter(t => t.id !== task.id);
                });
        }
    }
});

app.mount('#app');

