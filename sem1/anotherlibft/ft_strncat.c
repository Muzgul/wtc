/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strncat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/09 13:12:44 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 00:25:28 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strncat(char *restrict s1, const char *restrict s2, size_t n)
{
	size_t i;
	size_t x;

	i = 0;
	x = 0;
	while (s1[i] != '\0')
		i++;
	while (s2[x] != '\0' && x < n)
	{
		s1[i + x] = s2[x];
		x++;
	}
	s1[i + x] = '\0';
	return (s1);
}
