function getDate() {
  const week = {
    1: "Mon",
    2: "Tue",
    3: "Wed",
    4: "Thu",
    5: "Fri",
    6: "Sat",
    7: "Sun",
  };
  const date = new Date();
  let weekArr = [];
  let count = 8;
  let date6 = 0;
  let isClick = false;
  let month = date.getMonth();
  // + vào month để thay đổi tháng
  let year = date.getFullYear();
  //   let first = date.getDate() - date.getDay() + 1;
  //   const firstDay = new Date(date.setDate(first));
  let dateDay = date.getDate() - date.getDay() + 1;
  //+ vào dateDAy để thay đổi ngày

  const nextDate = document.querySelector(".js-next-date");
  const prevDate = document.querySelector(".js-prev-date");

  nextDate.onclick = () => {
    dateDay = date.getDate() - date.getDay() + 1;
    dateDay + 6;

    date.setDate(dateDay);
    weekArr = [];
    render(getWeekInMonth());
    isClick = true;
  };
  prevDate.onclick = () => {
    if (isClick) {
      dateDay = date.getDate() - date.getDay() + 1;
      date6 = 0;
    }
    if (date6 == 0) {
      date6 = dateDay - count;
      count += 7;
    }
    date.setDate(date6);
    weekArr = [];
    renderPrev(getWeekInMonthPrev());
    isClick = false;
  };
  //duyệt để get week , next week

  function getWeekInMonth() {
    for (let i = 0; i < 7; i++) {
      //check month
      if (
        month + 1 == "1" ||
        month + 1 == "3" ||
        month + 1 == "5" ||
        month + 1 == "7" ||
        month + 1 == "8" ||
        month + 1 == "10" ||
        month + 1 == "12"
      ) {
        //check date
        if (dateDay >= 32) {
          dateDay = 1;
          month++;
          date.setDate(dateDay);
          date.setMonth(month);
          console.log(month + " if 1 ");
        }
      } else {
        if (
          month + 1 == "4" ||
          month + 1 == "6" ||
          month + 1 == "9" ||
          month + 1 == "11"
        ) {
          if (dateDay >= 31) {
            dateDay = 1;
            month++;
            date.setDate(dateDay);
            date.setMonth(month);
            console.log(month + " if 2 ");
          }
        } else {
          if (dateDay >= 29) {
            dateDay = 1;
            month++;
            date.setDate(dateDay);
            date.setMonth(month);
            console.log(month + " if 3 ");
          }
        }
      }

      //check month > 12
      if (month > 12) {
        month = 1;
      }

      //get day,month,year thông qua biến đã tạo
      const getDay = new Date(date.setDate(dateDay));
      const getMonth = new Date(date.setMonth(month));
      const getYear = new Date(date.setFullYear(year));

      // get thứ
      const dayInWeek = week[getDay.getDay()];
      //format
      if (getDay.getDate() > 0 && getDay.getDate() < 10) {
        formatDate = "0" + getDay.getDate();
      } else {
        formatDate = getDay.getDate();
      }
      // gộp vào obj
      const objWeek = {
        dateInWeek: formatDate,
        weekOfMonth: getMonth.getMonth() + 1,
        weekOfYear: getYear.getFullYear(),
        dayInWeek: dayInWeek ? dayInWeek : "Sun",
      };
      //push vào mảng
      weekArr.push(objWeek);
      //++
      dateDay++;
    }
    return weekArr;
  }
  // prev week of year
  function getWeekInMonthPrev() {
    let c = 0;
    for (let i = 0; i < 7; i++) {
      if (
        month == "1" ||
        month == "3" ||
        month == "5" ||
        month == "7" ||
        month == "8" ||
        month == "10" ||
        month == "12"
      ) {
        //check date
        if (date6 == c) {
          date6 = 31;
          date.setDate(date6);
          month--;
          date.setMonth(month);
          console.log(month, date6, "if 1", c);
        }
      } else {
        if (month == "4" || month == "6" || month == "9" || month == "11") {
          if (date6 == c) {
            date6 = 30;
            date.setDate(date6);
            month--;
            date.setMonth(month);
          }
        } else {
          if (date6 == c) {
            date6 = 28;
            date.setDate(date6);
            month--;
            date.setMonth(month);

            console.log(month, date6, "if 3", c);
          }
        }
      }
      //check month > 12
      if (month < 1) {
        month = 12;
      }

      //get day,month,year thông qua biến đã tạo
      const getDay = new Date(date.setDate(date6));
      const getMonth = new Date(date.setMonth(month));
      const getYear = new Date(date.setFullYear(year));

      // get thứ
      const dayInWeek = week[getDay.getDay()];
      //format
      if (getDay.getDate() > 0 && getDay.getDate() < 10) {
        formatDate = "0" + getDay.getDate();
      } else {
        formatDate = getDay.getDate();
      }
      // gộp vào obj
      const objWeek = {
        dateInWeek: formatDate,
        weekOfMonth: getMonth.getMonth() + 1,
        weekOfYear: getYear.getFullYear(),
        dayInWeek: dayInWeek ? dayInWeek : "Sun",
      };
      //push vào mảng
      weekArr.push(objWeek);
      //++
      date6--;
    }
    return weekArr;
  }
  //call render

  render(getWeekInMonth());
  return { weekArr };
}

function render(data) {
  const jsDate = document.querySelectorAll(".js-date");
  const jsDisplayDate = document.querySelector(".js-dislay-date");
  console.log(data);
  const jsDateArr = Array.from(jsDate);
  //duyệt qa DOM lấy date
  jsDateArr.forEach((item, i) => {
    let date = data[i].dateInWeek;
    let day = data[i].dayInWeek;
    //   if (date > 0 && date < 10) {
    //     date = "0" + date;
    //   }
    item.innerHTML = `${day}, ${date}`;
  });
  //conver obj to arr
  let firstDate = Object.values(data[0]);
  let lastDate = Object.values(data[6]);
  // remove phan tu cuoi mang
  firstDateSplice = firstDate.splice(-1);
  lastDateSplice = lastDate.splice(-1);
  //inner vào html
  jsDisplayDate.innerHTML = `${firstDate.join("/")} - ${lastDate.join("/")}`;
}

function renderPrev(data) {
  const jsDate = document.querySelectorAll(".js-date");
  const jsDisplayDate = document.querySelector(".js-dislay-date");

  const jsDateArr = Array.from(jsDate);
  jsDateArr.reverse();
  //duyệt qa DOM lấy date
  jsDateArr.forEach((item, i) => {
    let date = data[i].dateInWeek;
    let day = data[i].dayInWeek;
    // if (date > 0 && date < 10) {
    //   date = "0" + date;
    // }
    item.innerHTML = `${day}, ${date}`;
  });
  //conver obj to arr
  let firstDate = Object.values(data[0]);
  let lastDate = Object.values(data[6]);
  // remove phan tu cuoi mang
  firstDateSplice = firstDate.splice(-1);
  lastDateSplice = lastDate.splice(-1);
  //inner vào html
  jsDisplayDate.innerHTML = `${lastDate.join("/")} - ${firstDate.join("/")}`;
}

getDate();
