<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Добавить задачу:</h3>
        </div>
        <div class="d-flex ">
            <form v-on:submit.prevent="addNewEvent" class="admin-form col-6 "
                  enctype="multipart/form-data">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                        </div>
                        <input type="text" name="name"
                               v-model="newEvent.name"
                               class="form-control"
                               placeholder="Название задачи"
                               required autofocus>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="input-group mb-3 col-5 p-0">
                            <div class="d-flex w-100">
                                <label for="">Начало задачи</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" name="start_date"
                                   class="form-control"
                                   v-model="newEvent.start_date"
                                   placeholder="Название задачи"
                                   required>
                        </div>
                        <div class="input-group mb-3 col-5 p-0">
                            <div class="d-flex w-100">
                                <label for="">Конец задачи</label>
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" name="end_date"
                                   class="form-control"
                                   v-model="newEvent.end_date"
                                   placeholder="Название задачи"
                                   required>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="d-flex w-100">
                            <label for="">Описание задачи</label>
                        </div>
                        <textarea class="form-control"
                                  v-model="newEvent.description"
                                  rows="3">

                        </textarea>

                    </div>
                </div>
                <button class="btn btn-success">Добавить</button>
                <button class="btn btn-info"
                        v-on:click.stop.prevent="updateEvent"
                        v-if="!addingMode"
                >Изменить
                </button>
                <button
                    v-if="!addingMode"
                    v-on:click.stop.prevent="deleteEvent"
                    class="btn btn-danger"
                >Удалить
                </button>
            </form>
            <div class="col-6">
                <Fullcalendar :options="calendarOptions"/>
            </div>
        </div>
    </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import ruLocale from "@fullcalendar/core/locales/ru"
import axios from "axios";

export default {
    components: {
        'Fullcalendar': Fullcalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: "",
                locale: ruLocale,
                // dateClick: this.handleDateClick,
                eventClick: this.getEvent,
            },

            newEvent: {
                name: "",
                start_date: "",
                end_date: "",
                description: "",
                color: 'purple'
            },
            addingMode: true,
            selectedTaskId: null
        };
    },
    created() {
        this.getEvents();
    },
    methods: {
        getEvent(info) {
            console.log(info.event)
            this.newEvent.name = info.event.title
            this.newEvent.description = info.event.extendedProps.description
            this.newEvent.start_date = info.event.startStr
            this.newEvent.end_date = info.event.endStr
            this.rerenderEvents(info.event.id)
            this.addingMode = false
            this.selectedTaskId = info.event.id
        },
        rerenderEvents(id) {
            let oldEvent = this.calendarOptions.events;
            this.calendarOptions.events = '';
            for (let i = 0; i < oldEvent.length; i++) {
                if (oldEvent[i].hasOwnProperty('color') && oldEvent[i].id === this.task || oldEvent[i].hasOwnProperty('color')) delete oldEvent[i].color;
                if (oldEvent[i].id === Number(id)) oldEvent[i].color = '#28a745';
            }
            this.calendarOptions.events = oldEvent
        },
        addNewEvent() {
            axios
                .post("/admin/dashboard/task/create", {
                    ...this.newEvent
                })
                .then(data => {
                    this.getEvents(); // update our list of events
                    this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
                })
                .catch(err =>
                    console.log("Unable to add new event!", err.response.data)
                );
        },
        updateEvent() {
            axios
                .put("/admin/dashboard/task/update/" + this.selectedTaskId, {
                    ...this.newEvent
                })
                .then(resp => {
                    this.resetForm();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                    this.selectedTaskId = null;
                })
                .catch(err =>
                    console.log("Unable to update event!", err.response.data)
                );
        },
        deleteEvent() {
            axios
                .delete("/admin/dashboard/task/delete/" + this.selectedTaskId)
                .then(resp => {
                    this.resetForm();
                    this.getEvents();
                    this.addingMode = !this.addingMode;
                    this.selectedTaskId = null;
                })
                .catch(err =>
                    console.log("Unable to delete event!", err.response.data)
                );
        },
        getEvents() {
            axios
                .get("/admin/dashboard/tasks")
                .then(resp => {
                    for (let i = 0; i < resp.data.data.length; i++) {
                        if (resp.data.data[i].id === this.task) resp.data.data[i].color = '#28a745'
                    }
                    this.calendarOptions.events = resp.data.data
                })
                .catch(err => console.log(err.response.data));
        },
        resetForm() {
            Object.keys(this.newEvent).forEach(key => {
                return (this.newEvent[key] = "");
            });
        }
    },
};
</script>

<style lang="css">
/*@import "~@fullcalendar/core/main.css";*/
@import "~@fullcalendar/daygrid/main.css";

</style>
