/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsearch.c                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/23 12:36:17 by mmacdona          #+#    #+#             */
/*   Updated: 2017/08/18 16:37:37 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../libft/libft.h"

size_t		ft_strsearch(const char *str, char c)
{
	size_t i;

	i = 0;
	if (str == NULL)
		return (0);
	while (str[i] != c && str[i] != '\0')
		i++;
	if (str[i] == c)
		return (i);
	return (0);
}
