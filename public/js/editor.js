export class Editor {
    constructor() { }

    /**
     * 에디터가 변경될 수 있기에 타입 설정
     * @param {{id:string, lang:string, type:string}} id 에디터를 적용시킬려는 textarea의 아이디
     * @param {*} lang 언어 설정 default: kr
     * @param {*} type 사용할 에디터 명 default: ckeditor
     */
    apply({ id, lang = "kr", type = "ckeditor" }) {
        switch (type) {
            case "ckeditor":
                this.ckEditor({ id: id, lang: lang });
                break;
            default:
                this.ckEditor({ id: id, lang: lang });
                break;
        }
    }
    /**
     * ckeditor5 클래식 입니다.
     * @param {{id:string, lang:string}} id 에디터를 적용시킬려는 textarea의 아이디
     * @param {*} lang 언어 설정
     */
    ckEditor({ id, lang = "kr" }) {
        ClassicEditor.create(document.getElementById(id), {
            // Editor configuration.
            plugin: ["Table", "TableColumnResize"],
            removePlugins: [],
            toolbar: {
                items: [
                    "selectall",
                    "removeformat",
                    "|",
                    "undo",
                    "redo",
                    "|",
                    "heading",
                    "|",
                    "bold",
                    "italic",
                    "Underline",
                    "link",
                    "bulletedList",
                    "numberedList",
                    "blockQuote",
                    "|",
                    "outdent",
                    "indent",
                    "|",
                    "imageUpload",
                    "insertTable",
                    "mediaEmbed",
                    "-",
                    "|",
                    "findandreplace",
                    "fontbackgroundColor",
                    "fontcolor",
                    "fontfamily",
                    "fontsize",
                    "highlight",
                ],
            },
            // fontFamily: {
            //     options: [
            //         'default',
            //         'Ubuntu, Arial, sans-serif',
            //         'Ubuntu Mono, Courier New, Courier, monospace'
            //     ]
            // },
            /**
             * ckeditor5에서 지원하는 기능
             * 서버에서 error message를 넘기면 업로드 안하고 삭제처리
             */
            simpleUpload: {
                uploadUrl: "/editor/ckeditor/upload",
                withCredentials: true,
            },
        })
            .then((editor) => {
                window.editor = editor;
            })
            .catch(this.ckEditorHandleSampleError);
    }
    ckEditorHandleSampleError(error) {
        const issueUrl = "https://github.com/ckeditor/ckeditor5/issues";

        // const message = [
        //     "Oops, something went wrong!",
        //     `Please, report the following error on ${issueUrl} with the build id "6vt5hzyjll3y-q8f9qcwzw30e" and the error stack trace:`,
        // ].join("\n");

        // console.error(message);
        console.error(error);
    }
}
