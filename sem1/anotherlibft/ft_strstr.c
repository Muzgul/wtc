/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strstr.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/09 13:23:25 by mmacdona          #+#    #+#             */
/*   Updated: 2017/07/22 15:37:04 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strstr(const char *big, const char *little)
{
	if (*little == '\0')
		return ((char*)big);
	while (*big != '\0')
	{
		if (ft_memcmp(big, little, ft_strlen(little)) == 0)
			return ((char*)big);
		big++;
	}
	return (NULL);
}
