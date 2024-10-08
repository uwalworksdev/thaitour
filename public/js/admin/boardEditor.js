import { Editor } from "../editor.js";

const editor = new Editor();

const id = document.querySelector("textarea[name='content']")?.id;
if (id) {
    editor.apply({ id: id });
}