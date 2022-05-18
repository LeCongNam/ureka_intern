import React from 'react';

export function transform_date(inputDate) {
    let date = new Date(inputDate)
    let day = date.getDay()
    day = day < 10 ? `0${day}` : day
    let month = date.getMonth() + 1
    month = month < 10 ? `0${month}` : month
    let year = date.getFullYear()
    return `${year}-${month}-${day}`
}

