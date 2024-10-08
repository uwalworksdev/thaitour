import { Editor } from "../../editor.js";

const editor = new Editor();

document.querySelectorAll("form[name='frm'] textarea").forEach(el => {
    editor.apply({ id: el.id })
})