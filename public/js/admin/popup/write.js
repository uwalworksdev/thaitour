
async function handleSubmit(event) {
    event.preventDefault();
    const form = event.target;
    if (!form.P_SUBJECT.value.trim()) {
        alert("팝업창 제목을 입력해주세요");
        form.P_SUBJECT.focus();
        return false;
    }
    if (!form.status.value) {
        alert("출력여부를 선택해주세요");
        form.status.focus();
        return false;
    }
    if (!form.device.value) {
        alert("출력기기를 입력해주세요");
        form.device.focus();
        return false;
    }
    // 이미지확인

    try {
        const formData = new FormData(form);
        let url = "./insert";
        if (idx) {
            // update
            url = `../update/${idx}`;
        }
        const result = await fetch(url, {
            method: "POST",
            body: formData,
        });
        const res = await result.json();

        if (!res.result) {
            throw new Error(res.message);
        }
        alert(res.message)

        if (idx) {
            location.reload();
        } else {
            location.href = "./list";
        }
    } catch (error) {
        alert(error.message);
        return false;
    }
}

document.querySelector("form[name='frm']").addEventListener("submit", handleSubmit);