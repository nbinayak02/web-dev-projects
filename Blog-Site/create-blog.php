<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="create-blog.css">
</head>

<body>

    <div class="container">
        <div id="response">
            <div class="text">;alsdkfja;sldj</div>
            <span class="loader-pro"></span>
        </div>
        <header>Create Post</header>
        <form id="form">
            <div class="input-field">
                <label>Title</label>
                <input type="text" name="title">
            </div>

            <div class="input-field">
                <label>Post Details</label>
                <textarea name="post-details" rows="15" cols="10"></textarea>
            </div>

            <div class="input-field">
                <label>Image</label>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="input-field">
                <label>Category</label>
                <select name="category">
                    <option value="ent">Entertainment</option>
                    <option value="edu">Education</option>
                    <option value="hlt">Health</option>
                    <option value="eco">Economy</option>
                    <option value="pol">Politics</option>
                    <option value="ai">Artificial Intelligence</option>
                    <option value="job">Job</option>

                </select>
            </div>
            <div class="input-field">
                <label>Author</label>
                <input type="text" name="author">
            </div>

            <div class="input-field">
                <label>Date</label>
                <input type="text" name="date">
            </div>
            <div class="btn">
                <input type="submit" name="submit" value="Create Post" id="submit">
                <div class="loader"></div>
            </div>
        </form>

    </div>
    <footer>

    </footer>
    <script>
        const btn = document.querySelector("#submit");
        document.getElementById("form").addEventListener("submit", function (event) {
            event.preventDefault();
            showSpinner()
            var formdata = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.onload) {
                    hideSpinner();
                    showResponseText(xhr.responseText);
                    setTimeout(hideResponseText, 6000);
                   
                }
            };
            xhr.open("POST", "insertData.php", true);
            xhr.send(formdata);


        })
        function showSpinner() {
            document.querySelector(".loader").style.display = "inline";
            btn.style.backgroundColor = "#597d7c";
            btn.style.cursor = "not-allowed";

        }
        function hideSpinner() {
            document.querySelector(".loader").style.display = "none";
            btn.style.backgroundColor = "#2B7A78";
            btn.style.cursor = "pointer";
        }
        function showResponseText(text){
            var res = document.querySelector("#response");
            res.style.display = "inline";
            res.innerHTML = text;

        }
        function hideResponseText(){
            document.querySelector("#response").style.display= "none";
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }
    </script>
</body>

</html>