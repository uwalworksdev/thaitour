

async function handleSubmit(event) {
    event.preventDefault();

    const form = event.target;

    if (!form.user_id.value.trim()) {
        alert("아이디를 입력해주세요");
        form.user_id.focus();
        return false;
    }
    if (!form.user_pw.value.trim()) {
        alert("비밀번호를 입력해주세요");
        form.user_pw.focus();
        return false;
    }
    const formData = new FormData(form);
    try {
        let url = form.action;
        const result = await fetch(url, {
            method: "POST",
            body: formData
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        location.href = res.location;
    } catch (error) {
        alert(error.message);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form[name='loginForm']").addEventListener("submit", handleSubmit);
})