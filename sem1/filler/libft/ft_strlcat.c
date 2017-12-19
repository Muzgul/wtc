/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strlcat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/06/09 13:15:17 by mmacdona          #+#    #+#             */
/*   Updated: 2017/10/01 00:33:49 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

size_t		ft_strlcat(char *restrict s1, const char *restrict s2, size_t size)
{
	size_t	i;
	size_t	s1_len;
	size_t	s2_len;
	size_t	total;

	i = 0;
	s1_len = ft_strlen(s1);
	s2_len = ft_strlen(s2);
	total = s1_len + s2_len;
	if (size < s1_len)
		return (s2_len + size);
	while (s2[i] && (size > s1_len + 1))
		s1[s1_len++] = s2[i++];
	s1[s1_len] = '\0';
	return (total);
}
