/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsub.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/05/24 13:15:49 by mmacdona          #+#    #+#             */
/*   Updated: 2017/07/25 15:46:43 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strsub(char const *s, unsigned int start, size_t len)
{
	size_t	i;
	char	*str;

	str = NULL;
	if (s != NULL)
	{
		str = ft_strnew(len);
		if (str == NULL)
			return (NULL);
		i = 0;
		while (i < len)
		{
			str[i] = s[i + start];
			i++;
		}
	}
	return (str);
}
