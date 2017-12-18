/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strnstr.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/07/24 14:43:31 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 00:32:53 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strnstr(const char *big, char *little, size_t len)
{
	size_t i;

	if (*little == '\0')
		return ((char*)big);
	i = 0;
	while (*big != '\0' && i < len)
	{
		if (ft_memcmp(big, little, ft_strlen(little)) == 0 &&
			(i + ft_strlen(little)) <= len)
			return ((char*)big);
		big++;
		i++;
	}
	return (NULL);
}
