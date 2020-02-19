<?php
    session_start();
    include("../main/cons/config.php");

    function repeat_date_every_day($start_date, $end_date)
    {
        // Change the datetime data to string
        $start_date = strtotime($start_date);
        $end_date = strtotime($end_date);

        $start_day = date("d", $start_date);
        $start_month = date("m", $start_date);
        $start_year = date("Y", $start_date);

        $end_day = date("d", $end_date);
        $end_month = date("m", $end_date);
        $end_year = date("Y", $end_date);


        $totalRemindMonth = array();
        $totalRemindDay = array();

        // Calculate total month that user want to remind him
        for($i = $start_month ; $i <= $end_month ; $i++)
        {
            if($i != $start_month)
            {
                $i = '0'.$i;
                array_push($totalRemindMonth, $i);
            }
            else 
            {
                array_push($totalRemindMonth, $i);
            }
        }

        if(count($totalRemindMonth) == 1)
        {
            for($i = $start_day ; $i <= $end_day ; $i++)
            {
                array_push($totalRemindDay, $i);
            }
            print_r($totalRemindDay);
        }
        else 
        {
            for($i = 0 ; $i < count($totalRemindMonth) ; $i++)
            {
                $currentMonth = $totalRemindMonth[$i];
                $currentMonthLastDay = calculate_dayOFMonth($currentMonth, $start_year);
                if($i == 0)
                {
                    for($j = $start_day ; $j <= $currentMonthLastDay ; $j++ )
                    {
                        array_push($totalRemindDay, $j);
                    }
                }
                else if( $i > 0 && $i < ( count($totalRemindMonth) - 1 ) )
                {
                    for($j = 1 ; $j <= $currentMonthLastDay ; $j++)
                    {
                        if($j >= 1 && $j <= 9)
                        {
                            $j = '0'.$j;
                            array_push($totalRemindDay, $j);
                        }
                        else 
                        {
                            array_push($totalRemindDay, $j);
                        }
                    }
                }
                else if( $i == ( count($totalRemindMonth) - 1 ) )
                {
                    for($j = 1 ; $j <= $end_day ; $j++)
                    {
                        if($j >= 1 && $j <= 9)
                        {
                            $j = '0'.$j;
                            array_push($totalRemindDay, $j);
                        }
                        else 
                        {
                            array_push($totalRemindDay, $j);
                        }
                    }
                }
            }
        }

        return $totalRemindDay;
    }

    function calculate_dayOFMonth_every_day($month, $year)
    {
        $dayOfMonth = 0;
        if($month == '01')
        {
            $dayOfMonth == 31;
        }
        else if($month == '02')
        {
            if($year % 4 == 0)
            {
                $dayOfMonth = 29;
            }
            else 
            {
                $dayOfMonth = 28;
            }
        }
        else if($month == '03')
        {
            $dayOfMonth = 31;
        }
        else if($month == '04')
        {
            $dayOfMonth = 30;
        }
        else if($month == '05')
        {
            $dayOfMonth = 31;
        }
        else if($month == '06')
        {
            $dayOfMonth = 30;
        }
        else if($month == '07')
        {
            $dayOfMonth = 31;
        }
        else if($month == '08')
        {
            $dayOfMonth = 31;
        }
        else if($month == '09')
        {
            $dayOfMonth = 30;
        }
        else if($month == '10')
        {
            $dayOfMonth = 31;
        }
        else if($month == '11')
        {
            $dayOfMonth = 30;
        }
        else if($month == '12')
        {
            $dayOfMonth = 31;
        }
        
        return $dayOfMonth;
    }

    if(isset($_SESSION['user']))
    {   
        if(isset($_POST['add']))
        {
            $id = $_SESSION['id'];
            $email = $_SESSION['email'];

            // Get data to save in the database
            $rem_desc = mysqli_real_escape_string($conn, $_POST['description']);
            $rem_start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
            $rem_end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
            $rem_repeat = mysqli_real_escape_string($conn, $_POST['repeat']);
            $rem_amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $rem_type = mysqli_real_escape_string($conn, $_POST['type']);

            // Insert into the database
            // $sql = "INSERT INTO reminder (reminder_id, reminder_description, reminder_start_date, reminder_end_date, reminder_repeat, reminder_type, check_reminder) values (null, '$rem_desc', '$rem_start_date', '$rem_end_date', '$rem_repeat', '$rem_type', ) ";

            // Check reminder repeat
            if($rem_repeat == "day")
            {
                repeat_date($rem_start_date, $rem_end_date);
            }

        }
        else if(isset($_POST['logout']))
        {
            header("location:logout.php?");
        }
    }
    else 
    {
        header("location:signin.php?");
    }
?>
<html>
    <head>
        <title>Add Reminder</title>
    </head>
    <body>
        <html>
            <form action="" method="POST">
                <label for="">Description:</label>
                <input type="text" name="description" placeholder="Description..."><br>  

                <label for="">Start Date:</label>
                <input type="date" name="start_date"><br>

                <label for="">End Date:</label>
                <input type="date" name="end_date"><br>

                <label for="">Repeat:</label>
                <select name="repeat" id="">
                    <option value="month">Every Month</option>
                    <option value="week">Every Week</option>
                    <option value="day">Every Day</option>
                </select><br>

                <label for="">Amount:</label>
                <input type="text" name="amount"><br>

                <label for="">Type:</label>
                <select name="type" id="">
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                    <option value="refund">Refund</option>
                    <option value="transfer">Transfer</option>
                </select><br>

                <input type="submit" name="add" value="Add">
                <input type="submit" name="logout" value="Log Out">

            </form>
        </html>
    </body>
</html>