
async function handleSubmit(event) {
    event.preventDefault();

    const form = event.target;

    if (!form.prev_pwd.value.trim()) {
        alert("이전 비밀번호를 입력해주세요");
        form.prev_pwd.focus();
        return false;
    }
    if (!form.pwd.value.trim()) {
        alert("비밀번호를 입력해주세요");
        form.pwd.focus();
        return false;
    }
    if (form.pwd.value.trim() != form.pwd_check.value.trim()) {
        alert("비밀번호가 일치하지 않습니다. 다시 입력해주세요");
        form.pwd_check.focus();
        return false;
    }
    const formData = new FormData(form);
    try {
        const url = "/adm/member/admin/change";
        const result = await fetch(url, {
            method: "POST",
            body: formData
        });
        const response = await result.json();
        if (!response.result) {
            throw new Error(JSON.stringify(response))
        }
        alert(response.message);
        location.reload();
    } catch (error) {
        const errorMsg = JSON.parse(error.message);
        alert(errorMsg.message);
        if (errorMsg.location) {
            location.href = errorMsg.location;
        }
        return false;
    }
}

document.querySelector("form[name='frm']").addEventListener("submit", handleSubmit)