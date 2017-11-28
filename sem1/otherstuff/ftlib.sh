#!/bin/bash
printf "/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   libft.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/30 11:52:40 by mmacdona          #+#    #+#             */
/*   Updated: 2017/06/06 13:50:28 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LIBFT_H
# define FT_LIBFT_H
# include <string.h>
# include <stdlib.h>
# include <unistd.h>\n\n" > libft.h

awk 'FNR == 15' *.c | sed 's/$/;/g' >> libft.h

echo "\n#endif" >> libft.h
