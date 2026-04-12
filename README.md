# MyToDoList2



## Part 1: Architecture and Database

### 

### 1\. General Project Structure

&#x09;

The project is built using the **MVC (Model-View-Controller)** pattern, which allows responsibilities to be separated among different parts of the code:



* **Model:** The Task and User classes are responsible for handling data and database queries.
* **View:** Files in the views folder (e.g., TaskView.php) are responsible for rendering HTML to the user.
* **Controller:** The TaskController and AuthController classes process input data and manage the application’s logic.
* **Front Controller:** The index.php file serves as the single entry point, initializing the system and routing requests via the action parameter.



### 2\. Work with Database (PDO)



The PDO (PHP Data Objects) extension is used to interact with MySQL. This provides:



* **Versatility:** The ability to easily change the database type in the future.
* **Security:** Use of prepared statements (prepare and execute) to protect against SQL injection.
* **Typing:** Model constructors require an object of type PDO, which ensures that an active connection is present.

### 3\. Task.php Model Logic

### 

Class Task includes methods to implement CRUD operations (Create, Read, Update, Delete): 



* getAll($userId, $filter): Gets list of tasks, using filtration (All, Active, Completed) and sort.
* getById($id, $userId): Uses fetch(PDO::FETCH\_ASSOC) to get only one specific query.
* create($title, $description, $userId): Add new task in DB.
* delete($id): Deletes task by his ID.
* toggleStatus($userId): Change is\_completed status.
* getStatus($userId): Uses aggregate functions SQL (COUNT, SUM), to get  stats for upper panel.
* deleteByUserId($userId): Method for Admin - gives ability to delete task from specific user.
* update($id, $title, $userId): Gives ability to edit tasks.



## Part 2: Validation and Routing



### 4\. Data Validation (TaskValidator)



Before being saved to the database, the data is validated on the server.



Method **validate(array $data):** Validate that the task name can't be empty, and length of task name (max 128 characters).



**Error handling:** 

* Method **getErrors()** - returns array of errors. 
* Errors are stored in an array and passed to the view via the **$\_SESSION\['errors']** session variable, after which they are removed using unset.



### 5\. Routing



The index.php file implements a mechanism that determines what to display to the user:



* The **$\_GET\['action']** parameter specifies the page (login, register, edit, admin).
* If the parameter is missing, the **?? 'home'** operator sets the default value.
* For actions that modify data (e.g., **add\_task**), **$\_POST** parameters are used.



### Part 3: Authorize and Security



### 6\. Mechanism of Sessions and Authorization



To protect users' personal data, an authorization system has been implemented:



* **Session start:** Function **session\_start()** calls in main file **index.php**.
* **Identification:** After succesfull authorization, in array **$\_SESSION\['user\_id']** writes unique ID of user. This allows server to "recognize" a user when navigating between pages using the **PHPSESSID** (unique session ID that creates automatically by calling **session\_start()** function) cookie.
* **Access control:** Most methods in controllers begin by checking if **$\_SESSION\['user\_id']** exists. If the user is not logged in, the system redirects them to the page that offers: ***login*** or ***register*** using **header("Location: ...")**.



### 7\. Data security



Project secured from two basic types of attack:

* **SQL-injections:** By using prepared statements in **PDO** (prepare and execute), input data is never inserted directly into the SQL code. The database receives the data separately from the command.
* **XSS (Cross-Side Scripting):** When displaying any text that a user might have entered (task names, usernames), the **htmlspecialchars()** function is used. It converts the **<** and **>** characters into safe text, preventing the browser from executing malicious scripts.



### 8\. Passwords hashing



User passwords are never saving in the open view.

* To write are using function **password hash()**, which creates complex irreversible code.
* The **password\_verify()** function is used for login verification. This helps make sure that even if the database is compromised? hackers won't be able to find out the actual passwords.



## Part 4: Patterns and Standards



### 9\. Front Controller and PRG



* **Front Controller:** The entire project is controlled by a single index.php file. This allows for centralized configuration of database connections and management of access permissions.
* **PRG (Post-Redirect-Get):** After each succsessful operation (addition, deletion), the server redirects back to idex.php using header(). This prevents thew form from being resubmitted when the page is refreshed (by pressing F5).

### 10\. Code Standarts

### 

* **PSR-4:** This is used to automatically load classes via Composer. You don't need to write hundreds of **require** statements, the system automatically finds the fles based on their namespaces.
* **Type hinting:** Models and controller methods use type hints (e.g., PDO $db), which makes code more stable.

