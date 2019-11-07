import $ from "jquery"
import _ from "lodash"

class Todo {

    renderTaskDisplay(text) {
        $(".text-display").html(text);
    }
    
    renderTaskList() {
        $.ajax("api/task")
            .done((data) => {
                $(".todo-list").html(_.map(data, (d) => {
                    const { id, name, is_done: isDone } = d;
                    return this.getCheckboxTemplate(id, name, isDone);
                }).join(""));
                this.checkboxHandler();
            });
    }

    getCheckboxTemplate(id, name, isDone) {
        return `<input id="${id}" class="ck" type="checkbox" name="ch-${id}" value="${id}" ${ isDone ? "checked" : ""}>
                        <label for="${id}">${name}</label><br/>` 
    }

    checkboxHandler() {
        $("input[type=checkbox]").on("change", (event) => {
            let isDone = false;
            if ($(event.target).is(":checked")) {
                isDone = true;
            }
            $.ajax({
                url: `api/task/${$(event.target).val()}`,
                method: "PUT",
                dataType: "json",
                data: {
                    isDone
                }
            })
            .done((response) => {
                if (response.code !== 200) {
                    alert("Oops! Something gonna be wrong")
                }
            })
        })
    }

    handleSave() {
        $("#save").on("click", (event) => {
            event.preventDefault();
            if ($("input[name=task]").val()) {
                $.ajax({
                    method: "POST",
                    url: "api/task",
                    data: {
                        "name": $("input[name=task]").val()
                    }
                })
                .done((response) => {
                    if (response.code === 201) {
                        const { id, name, is_done: isDone } = response.data;
                        $(".todo-list").append(this.getCheckboxTemplate(id, name, isDone));
                        this.checkboxHandler();
                    }
                })
            }
        });
    }

    handleRemove() {
        $("#remove").on("click", () => {
            const ids = _.map($("input[type=checkbox]:checked"), (el) => {
                return $(el).val();
            });
            $.ajax({
                url: "api/task",
                method: "delete",
                data: {
                    ids
                }
            })
            .done((response) => {
                if (response.code === 200) {
                    this.renderTaskList();
                } else {
                    alert("Oops! Something Gonna be Wrong")
                }
            })
        })
    }

    render() {
        this.renderTaskList();
        this.handleSave();
        this.handleRemove();
        $("input[name=task]").keyup((event) => this.renderTaskDisplay($(event.target).val()));
    }
}

export default Todo;