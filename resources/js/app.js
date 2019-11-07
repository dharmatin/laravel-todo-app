import $ from "jquery";
import Todo from "./todo"

$(document).ready(() => {
    const todo = new Todo();
    todo.render();
})
